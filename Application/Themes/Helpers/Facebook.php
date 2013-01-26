<?php
    namespace Application\Themes\Helpers;

    class Facebook {
        public function getLink() { 
            $auth = \Saros\Auth::getInstance();

            $text = "";
            $url = "";
            if($auth->hasIdentity() || $auth->getLastCode() == \Application\Classes\Auth\Adapter\FbDb::YES_FB_NO_DB) {
                $text = "Logout";

                $url = $GLOBALS['registry']->facebook->getLogoutUrl(
                array(
                "redirect_uri" => $GLOBALS["registry"]->utils->makeLink("Register", "facebookCallback") 
                )
                );
            } else {
                $text = "Log in";
                $url = $GLOBALS['registry']->facebook->getLoginUrl(
                    array(
                        "scope" =>
                        array(
                            "email"
                        ),
                        "redirect_uri" => $GLOBALS["registry"]->utils->makeLink("Register", "facebookCallback")
                    ) 
                );
            }
        ?>

        <a href="<?php echo $url?>"><?php echo $text ?></a>

        <?php
        }
    }
?>
