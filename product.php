<?php

require_once('PDO.php');

 class Product
{
    protected $con;
    function __construct()
    {
        $PDO=new conn();
        $this->con=$PDO->connection();
    }

    function addProduct()
    {
        $checkIfDataWasSent =isset($_POST['name']) && isset($_POST['shortText']);
        if($checkIfDataWasSent)
        {
            $this->deadWalker('Form is invalid', 400);
        }
        $name=stripslashes($_POST['name']);
        $shortText=stripslashes($_POST['shortText']);
        $fullText=isset($_POST['fullText']) ?stripslashes($_POST['fullText']): $shortText;
        try{
        $sql=$this->con->prepare('INSERT INTO products (name, short_texts, full_texts) VALUES(:name, :short, :full)');
        $sql->execute(['name'=>$name,'short'=>$shortText,'full'=>$fullText]);
        }catch(PDOException $e)
        {
            $message=$e->getMessage();
            $this->deadWalker($message,500);
        }
        return array('success'=>true, 'Produkt został dodany');
    }

    protected function deadWalker($message, $error)
    {
        http_response_code($error);
        $response= array('success'=>false, 'message'=>$message);
        die(json_encode($response));
    }

}


?>
