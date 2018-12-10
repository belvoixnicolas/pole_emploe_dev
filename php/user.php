<?php
//require_once($_SERVER['DOCUMENT_ROOT'] . '/pole_emploe_dev/php/connect.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/php/connect.php');

class Utilisateur {
    // variable //
        private $_id;
        private $_nom;
        private $_prenom;
        private $_naissance;
        private $_creation;
        private $_mail;
        private $_img;
        private $_verif;
        private $_role;
        private $_ville;
    // variable //

    // init //
        public function init($id) {
            $dbh = connect();
            $req = $dbh->prepare('SELECT usser.id, nom, prenom, date_naissance, date_creation, mail, img, verif, role, ville FROM usser INNER JOIN ville ON usser.id_ville = ville.id WHERE usser.id = :id');
            $req->execute(array(':id' => $id));
            if ($req = $req->fetch()) {
                $this->_id = htmlentities($req['id']);
                $this->_nom = htmlentities($req['nom']);
                $this->_prenom = htmlentities($req['prenom']);
                $this->_naissance = htmlentities($req['date_naissance']);
                $this->_creation = htmlentities($req['date_creation']);
                $this->_mail = htmlentities($req['mail']);
                $this->_img = htmlentities($req['img']);
                $this->_verif = htmlentities($req['verif']);
                $this->_role = htmlentities($req['role']);
                $this->_ville = strtolower(htmlentities($req['ville']));
            }else {
                return 'l\'id est invalid ou il manque des donner';
            }
        }
    // init //

    // GET //
        public function get($donner=null) {
            if ($donner == null) {
                $array = array();
                $array[] = $this->_id ;
                $array[] = $this->_nom;
                $array[] = $this->_prenom;
                $array[] = $this->_naissance;
                $array[] = $this->_creation;
                $array[] = $this->_mail;
                $array[] = $this->_img;
                $array[] = $this->_verif;
                $array[] = $this->_role;
                $array[] = $this->_ville;
                return $array;
            }else{
                switch ($donner) {
                    case 'id':
                        return $this->_id;
                        break;

                    case 'nom':
                        return $this->_nom;
                        break;

                    case 'prenom':
                        return $this->_prenom;
                        break;

                    case 'naissance':
                        return $this->_naissance;
                        break;

                    case 'creation':
                        return $this->_creation;
                        break; 

                    case 'mail':
                        return $this->_mail;
                        break; 

                    case 'img':
                        return $this->_img;
                        break; 

                    case 'verif':
                        return $this->_verif;
                        break; 

                    case 'role':
                        return $this->_role;
                        break;
                    
                    case 'ville':
                        return $this->_ville;
                        break;

                    default:
                        return 'Cette valeur n\'existe pas';
                        break;
                }
            }
        }
    // GET //

    // SET //
        public function set($variable=NULL, $donner=NULL) {
            if ($donner==NULL || $variable==NULL) {
                return "echo 'Il manque une variable'";
            }
            switch ($variable) {
                case 'id':
                    $this->_id = $donner;
                    break;

                case 'nom':
                    $this->_nom = $donner;
                    break;

                case 'prenom':
                    $this->_prenom = $donner;
                    break;

                case 'naissance':
                    $this->_naissance = $donner;
                    break;

                case 'creation':
                    $this->_creation = $donner;
                    break; 

                case 'mail':
                    $this->_mail = $donner;
                    break; 

                case 'img':
                    $this->_img = $donner;
                    break; 

                case 'verif':
                    $this->_verif = $donner;
                    break; 

                case 'role':
                    $this->_role = $donner;
                    break;
                
                case 'ville':
                    $this->_ville = $donner;
                    break;

                default:
                    return 'Cette valeur n\'existe pas';
                    break;
            }
        }
    // SET //
} 
?>