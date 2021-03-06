<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;
use Cake\Database\Connection;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
			'limit' => 15,
			'order' => [
				'Users.id' => 'asc'
			],
            'contain' => ['Roles']
        ];
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
		//// prerobit
        //$user = $this->Users->get($id, [
        //    'contain' => ['Roles', 'Needs']
        //]);
        //$this->set('user', $user);
        //$this->set('_serialize', ['user']);
        
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
			'select u.id as u_id, u.username as u_username, u.creation_date as u_creation_date, r.id as r_id, r.name as r_name
			from users as u
			join roles as r on u.role_id = r.id
			where u.id = ?', 
			[$id], ['integer']);
        $user = $stmt->fetch('assoc');
        $this->set('user', $user);     
        
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
			// PREPISAT S POUZITIM NAME NAMIESTO ID        
			'select n.id as n_id, n.user_id as n_user_id, n.product_id as n_product_id, n.quantity as n_quantity, n.creation_date as n_creation_date
			from needs as n
			join users as u on n.user_id = u.id
			where u.id = ?', 
			[$id], ['integer']);
        $needs = $stmt->fetchAll('assoc');
        $this->set('needs', $needs);               
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$conn = ConnectionManager::get('default');
		
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            $conn->begin();
			$stmt = $conn->execute(
			'insert into users (username, password, role_id) values (?, ?, ?)', 
			[$user['username'], $user['password'], $user['role_id']], ['string', 'string', 'integer']);
			$conn->commit();
			$errcode = $stmt->errorCode();

            if ($errcode) {
            // orig
            //if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
        $stmt = $conn->execute('select id, name from roles');
        $tmproles = $stmt->fetchAll('assoc');
        $roles = array();
        foreach($tmproles as $tmprole) {
			$roles += array($tmprole['id'] => $tmprole['name']);
		}
        $this->set('roles', $roles);
        // orig
        //$roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		// TODO: VYHODIT ZMENU MENA
		$conn = ConnectionManager::get('default');
		
		// orig
        //$user = $this->Users->get($id, [
        //    'contain' => []
        //]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
			// orig
            //$user = $this->Users->patchEntity($user, $this->request->data);
			$data = $this->request->data;
			$conn->begin();
			$stmt = $conn->execute(
			'update users set username = coalesce(?, username), password = coalesce(?, password), role_id = coalesce(?, role_id) where id = ?', 
			[$data['username'], $data['password'], $data['role_id'], $id], ['string', 'string', 'integer', 'integer']);
			$conn->commit();
			$errcode = $stmt->errorCode();

            if ($errcode) {
			// orig		            
            //if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
		$this->set('user_id', $id);

        $stmt = $conn->execute('select id, name from roles');
        $tmproles = $stmt->fetchAll('assoc');
        $roles = array();
        foreach($tmproles as $tmprole) {
			$roles += array($tmprole['id'] => $tmprole['name']);
		}
        $this->set('roles', $roles);
        
        // role
        //$roles = $this->Users->Roles->find('list', ['limit' => 200]);
        //$this->set(compact('user', 'roles'));
        //$this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
		// TODO: KONTROLA, CI NAN NIE SU NAVIAZANE NEJAKE NEEDS PRED DELETOM
        $this->request->allowMethod(['post', 'delete']);
        // orig
        //$user = $this->Users->get($id);
		$conn = ConnectionManager::get('default');	
		$conn->begin();
		$stmt = $conn->execute(
		'delete from users where id = ?', [$id], ['integer']);
		$conn->commit();
		$errcode = $stmt->errorCode();        
        
        if ($errcode) {
		// orig        
        //if ($this->Users->delete($user)) {
            $this->Flash->success('The user has been deleted.');
        } else {
            $this->Flash->error('The user could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
    
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		// Allow users to register and logout.
		// You should not add the "login" action to allow list. Doing so would
		// cause problems with normal functioning of AuthComponent.
		$this->Auth->allow(['logout']);
	}

	public function login()
	{
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if ($user) {
				$this->Auth->setUser($user);
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error(__('Invalid username or password, try again'));
		}
	}

	public function logout()
	{
		return $this->redirect($this->Auth->logout());
	}       
}
