<?php

// id database class exist then extend it
class Notes
{
    private $con;
    public function __construct()
    {
        $this->con = new mysqli("localhost", "root", "", "phpnotes");
    }

    public function add_note($user_id, $title, $dis)
    {
        $title = $this->con->real_escape_string($title);
        $dis = $this->con->real_escape_string($dis);
        $qry = "INSERT INTO `notes` VALUES(NULL, '$user_id', '$title', '$dis')";
        if ($this->con->query($qry)) {
            $message = "Inserted";
            // header("locaiton:index.php");
        }
    }

    public function update_note($user_id, $note_id, $title, $dis)
    {
        $title = $this->con->real_escape_string($title);
        $dis = $this->con->real_escape_string($dis);
        $qry = "UPDATE `notes` SET `title` = '$title', `dis` = '$dis' WHERE `id` = '$note_id' AND `user` = '$user_id'";
        if ($this->con->query($qry)) {
            $message = "Updated";
            // header("locaiton:index.php");
        }
    }
    public function delete_note($user_id, $note_id)
    {

    }
}
/*
How to Call This Function

--config.php or database class
function get($key)
{
    if(isset($_POST[$key]))
    {
        return $_POST[$key];
    }
    else
    {
        return '';
    }
}
--index.php

$user = new User();
$note = new Notes();
if(isset($_POST["add"]))
{
    $title = $note->get("title");
    $dis = $note->get("dis");
    $note->add_note($user->get_id, $title, $dis);
}
*/