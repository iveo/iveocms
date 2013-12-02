<?
        if(isset($_SESSION['user']) && $_SESSION['user'] != '')
        {
                $db = mysql_connect(DB_HOST, DB_USERS, DB_PWD)or die('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
                mysql_select_db(DB_SELECT, $db)or die('Erreur SQL de select !<br>'.$sql.'<br>'.mysql_error());
                mysql_query("SET NAMES 'utf8'");
 
                $sql = "SELECT * FROM hostime_users WHERE id = ".$_SESSION['id']."";
                $req = mysql_query($sql,$db) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
               
                while($data = mysql_fetch_assoc($req))
                {
                        // $h_name[$data['id']] = $data['nom'];
                        $name = $data['user'];
                        $mail = $data['email'];
                        $tokens = $data['tokens'];
                        // $id = $data['id'];
                        $root = $data['root'];
                }
               
				$_SESSION['user'] = $name;
				$_SESSION['mail'] = $mail;
				$_SESSION['tokens'] = $tokens;
				$_SESSION['co'] = true;
				// $_SESSION['id'] = $id;
				$_SESSION['root'] = ($root == 1 ? true : false);
                // setcookie('id', $id, time() + 1*12*3600, null, null, false, true);
                // setcookie('user', $name, time() + 1*12*3600, null, null, false, true);
                // setcookie('mail', $mail, time() + 1*12*3600, null, null, false, true);
                // setcookie('tokens', $tokens, time() + 1*12*3600, null, null, false, true);
                // setcookie('co', "true", time() + 1*12*3600, null, null, false, true);
                // setcookie('root', ($root == 1 ? true : false), time() + 1*12*3600, null, null, false, true);
               
                mysql_close();
 
        }
?>