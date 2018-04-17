<?php
class My_EditManager
{
    private $backend;

    /**
     *
     * backendへ値を入れるためのコンストラクタ
     *
     * @access public
     * @param  &$backend
     *
     */
    public function __construct(&$backend)
    {
        $this->backend = $backend;
    }

    /**
        *  指定された写真をDBとディレクトリから削除する
        *
        *  @param photoNames array
     */
    public function deletePhotos($photosId)
    {
        foreach ($photosId as $photoId) {
            $modelPhotos = new My_ModelPhotos($this->backend);
            $photoName = $modelPhotos->getPhotoName($photoId);
            unlink("sherImage/$photoName");
            $modelPhotos->delPhoto($photoId);
        }
    }
}
