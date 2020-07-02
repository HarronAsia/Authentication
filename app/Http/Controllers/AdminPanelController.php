<?php

namespace App\Http\Controllers;

use App\AdminPanel;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\StoreAdmin;
use App\Http\Requests\StoreContent;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Admin\AdminRepositoryInterface;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AdminPanelController extends Controller
{
    protected $adminRepo;
    public function __construct(AdminRepositoryInterface $adminRepo)
    {
        $this->middleware('auth');
        $this->adminRepo = $adminRepo;
    }

    public function index()
    {
        $users = $this->adminRepo->countAllUsers();
        $managers = $this->adminRepo->countAllManagers();
        $admins = $this->adminRepo->countAllAdmins();
        $managers_events = $this->adminRepo->countAllEventsByManager();
        $admins_events = $this->adminRepo->countAllEventsByAdmin();
        $managers_events_contents = $this->adminRepo->countallContentByEventByManager();
        $admins_events_contents = $this->adminRepo->countallContentByEventByAdmin();


        return view('admin.dashboard', compact('users', 'managers', 'admins', 'managers_events', 'admins_events', 'managers_events_contents', 'admins_events_contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdminPanel  $adminPanel
     * @return \Illuminate\Http\Response
     */
    public function show(AdminPanel $adminPanel)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdminPanel  $adminPanel
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminPanel $adminPanel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdminPanel  $adminPanel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminPanel $adminPanel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdminPanel  $adminPanel
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminPanel $adminPanel)
    {
        //
    }
    //*===============For User=============================*//
    public function users()
    {
        $users = $this->adminRepo->getAllUsers();
        return view('admin.lists.users_list', compact('users'));
    }

    public function updateusers($id)
    {
        $user = User::findOrFail($id);
        dd('member', $user);
        $this->adminRepo->editforAdmin($user->id);

        return redirect('/admin/users/lists');
    }

    public function destroyusers($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/admin/users/lists');
    }
    //*===============For User=============================*//

    //*===============For Manager=============================*//
    public function managers()
    {
        $users = $this->adminRepo->getAllManagers();
        return view('admin.lists.managers_lists', compact('users'));
    }

    public function editmanagers($id)
    {
        $user = User::findOrFail($id);
        return view('admin.lists.managers.edit_manager', compact('user'));
    }

    public function updatemanagers($id)
    {
        $user = User::findOrFail($id);
        dd( $user);
        $this->adminRepo->editforAdmin( $user->id);

        return redirect('/admin/manager/lists');
    }

    public function destroymanagers($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/admin/manager/lists');
    }
    //*===============For Manager=============================*//

    //*===============For Admin=============================*//
    public function admins()
    {
        $users = $this->adminRepo->getAllAdmins();
        return view('admin.lists.admins_lists', compact('users'));
    }

    public function editadmins($id)
    {
        $user = User::findOrFail($id);
        return view('admin.lists.admins.edit_admin', compact('user'));
    }

    public function updateadmins($id)
    {
        $user = User::findOrFail($id);
        //dd('admin',$user);
        $this->adminRepo->editforAdmin($user->id);

        return redirect('/admin/lists');
    }

    public function destroyadmins($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/admin/lists');
    }
    //*===============For Admin=============================*//

    //*===============For edit=============================*//
    public function editadmin($id)
    {
        $user = User::findOrFail($id);
        return view('admin.lists.admins.edit_admin', compact('user'));
    }
    public function editmanager($id)
    {
        $user = User::findOrFail($id);
        return view('admin.lists.managers.edit_manager', compact('user'));
    }
    public function editmember($id)
    {
        $user = User::findOrFail($id);
        return view('admin.lists.users.edit_user', compact('user'));
    }
    //*===============For edit=============================*//

    //*===============For cofirm=============================*//
    public function confirmforAdmin(StoreAdmin $request, $id)
    {
        $value = User::findOrFail($id);

        $user = $this->adminRepo->confirmAdmin($request, $value->id);

        return view('confirms.admin.edit', compact('user'));
    }

    public function confirmManager(StoreAdmin $request, $id)
    {
        $value = User::findOrFail($id);

        $user = $this->adminRepo->confirmAdmin($request, $value->id);

        return view('confirms.admin.editmanager', compact('user'));
    }

    public function confirmMember(StoreAdmin $request, $id)
    {
        $value = User::findOrFail($id);

        $user = $this->adminRepo->confirmAdmin($request, $value->id);

        return view('confirms.admin.edituser', compact('user'));
    }
    //*===============For cofirm=============================*//
}
