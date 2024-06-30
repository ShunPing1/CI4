<?php

namespace App\Controllers;

use App\Models\DatabaseModel;

class memberPage extends BaseController
{
    public function index(): string
    {
        $model = new DatabaseModel();

        $data['states'] = $model->findAll();
        return view('Pages/memberList',$data);
    }

    // Create
    public function create()
    {
        $model = new DatabaseModel();

        $data = [
            'os_sort' => $this->request->getPost('sort'),
            'os_name' => $this->request->getPost('name'),
        ];

        $model->save($data);

        return redirect()->to('memberPage');
    }

    // edit Page
    public function edit($id)
    {
        $model = new DatabaseModel();
        $data['states'] = $model->find($id);

        return view('Pages/edit', $data);
    }

    // update
    public function update($id)
    {
        $model = new DatabaseModel();

        $data = [
            'os_sort' => $this->request->getPost('os_sort'),
            'os_name' => $this->request->getPost('os_name'),
        ];

        $model->update($id, $data);

        return redirect()->to('memberPage');
    }

    // DELETE
    public function delete($os_id)
    {
        $model = new DatabaseModel();
        $model->delete($os_id);

        return redirect()->to('memberPage');
    }

}
