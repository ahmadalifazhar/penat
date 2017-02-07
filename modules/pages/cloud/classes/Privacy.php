<?php
/**
 * Created by faridyusof727@gmail.com.
 * Date: 6/16/13
 * Time: 8:07 PM
 */

class Privacy
{
    var $folder_sql;
    var $album_sql;
    var $privacy = 0;

    function __construct($user, $privacy)
    {
        $this->setPrivacy($privacy);
        $this->Folder($user);
    }

    public function Folder($user)
    {
        if ($this->privacy == 1)
        {
            $query = "SELECT f.folder_id, f.name, f.date, f.privacy FROM folder f WHERE (f.owner = '" . $user . "' OR f.owner = 'def') AND f.type = 1 AND f.privacy = 0";
        }
        else
        {
            $query = "SELECT f.folder_id, f.name, f.date, f.privacy FROM folder f WHERE (f.owner = '" . $user . "' OR f.owner = 'def') AND f.type = 1";
        }
        $this->folder_sql = $query;
    }

    public function Album($user)
    {
        if ($this->privacy == 1)
        {
            $query = "SELECT f.folder_id, f.name, f.date, f.privacy FROM folder f WHERE (f.owner = '" . $user . "' OR f.owner = 'def') AND f.type = 2 AND f.privacy = 0";
        }
        else
        {
            $query = "SELECT f.folder_id, f.name, f.date, f.privacy FROM folder f WHERE (f.owner = '" . $user . "' OR f.owner = 'def') AND f.type = 2";
        }
        $this->album_sql = $query;

    }

    public function setPrivacy($value)
    {
        if ($value == 1)
        {
            $this->privacy = 1;
        }
        else
        {
            $this->privacy = 0;
        }
    }

    public function getfolder_sql()
    {
        return $this->folder_sql;
    }

    public function getalbum_sql()
    {
        return $this->album_sql;
    }


}