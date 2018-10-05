<nav>
    <div class="main_nav">
        <img src="./img/resource/logo.jpg" alt="logo">

        <ul>
            <?php if (isset($_SESSION['user']) && $_SESSION['user'] != NULL) { ?>
                <li>
                    <a href="#" class="job">
                        

                        <span>
                            <?php 
                                if ($_SESSION['user']->get('role') == 1) { ?>
                                    <i class="fas fa-terminal"></i>
                                    <span>
                                        Chercher une offre
                                    </span>
                                <?php } elseif ($_SESSION['user']->get('role') == 2) { ?>
                                    <i class="fas fa-handshake"></i>
                                    <span>
                                        Chercher un développeur
                                    </span>
                                <?php }else {
                                    echo 'erro';
                                }
                            ?>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#" class="mail">
                        <i class="fas fa-envelope"></i>

                        <span>
                            Email
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#" class="profil">
                        <i class="fas fa-user-alt"></i>
                        <span>
                            Profil
                        </span>
                    </a>
                </li>
            <?php } ?>
        </ul>

        <?php if (isset($_SESSION['user']) && $_SESSION['user'] != NULL) { ?>
            <button class="deco">
                <i class="fas fa-sign-in-alt"></i>
                <span>Déconnecxion</span>
            </button>
        <?php }else { ?>
            <button class="connect">
            <i class="far fa-user"></i>
            <span>Connexion</span>
            </button>
        <?php } ?>
    </div>
    <?php if (isset($_SESSION['user']) == false) { ?>
        <form action="<?php echo $_SERVER['PHP_SELF']?>?form=ident" method="post">
            <input type="text" name="mail" placeholder='Email'>
            <input type="password" name="mdp" placeholder="Mot de passe">
            <input type="submit" value="tester">
        </form>
    <?php } ?>
</nav>

<?php if (isset($_SESSION['user']) && $_SESSION['user'] != NULL) { ?>
    <script>var int = <?php echo $_SESSION['user']->get('id'); ?>;</script>
    <script src="./js/ajax/notif.js"></script>
<?php } ?>

<script src="./js/nav.js"></script>
