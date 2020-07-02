<?php
namespace App\Repositories\Content;
use  App\Http\Requests\StoreContent;
interface ContentRepositoryInterface
{

    public function editContent($id);

    public function confirmadd(StoreContent $request, $id);

    public function addContent();

    public function confirmupdate(StoreContent $request, $id);

    public function updateContent($id);


}