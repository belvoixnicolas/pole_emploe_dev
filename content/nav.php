<nav>
    <div class="main_nav">
        <img src="./img/resource/logo.jpg" alt="logo">

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

<script src="./js/nav.js"></script>