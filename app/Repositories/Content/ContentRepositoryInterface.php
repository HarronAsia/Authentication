<?php
namespace App\Repositories\Content;
use  App\Http\Requests\StoreContent;
interface ContentRepositoryInterface
{

    public function editContent($id);

    public function addContent(StoreContent $request, $id);

    public function updateContent(StoreContent $request, $id);

}