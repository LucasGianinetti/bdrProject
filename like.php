<?php 
    require_once "connexion bbd.php";
?>
<?php
        if(isset($_POST)){


                switch($_POST['action']){
                    case 'like':
                        like();
                        break;
                    case 'dislike':
                        dislike();
                        break;
                }
            
            function like(){

                $idUser = $_SESSION['userlogin']['id'];
                $idMusic = $_GET['id'];
               $sql = "INSERT INTO Customer_Music (idUser, idMusic)
                        VALUES(?,?);";
                $stmtinsert = $bdd->prepare($sql);
                $result = $stmtinsert->execute([$idUser,$idMusic]);
                if($result){
                    echo 'Très bon choix !';
                }else{
                    echo 'There were errors while saving your data.';
                }
                exit;
            }

            function dislike(){
                        $idUser = $_SESSION['userlogin']['id'];
                $idMusic = $_GET['id'];
                $sql = "DELETE FROM Customer_Music WHERE idUser ='$idUser' AND idMusic ='$idMusic'";
                $sql->fetch();
                exit;
            }
    }else{
        echo "No data";
    }
?>