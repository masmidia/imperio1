<div id="container-conteudo-topo">
    <h1>Administração do site</h1>
    <div id="container-conteudo-topo-user" style="margin-top:10px;">
        Bem vindo(a), <?php Util::imprime($_SESSION['login']['nome']); ?>
    </div>
    <div id="container-conteudo-topo-acesso">
        <!--Último acesso: 21/03/2010 às 21h17-->
    </div>
    <div id="container-conteudo-topo-link">
        <a href="<?php echo Util::caminho_projeto(); ?>/admin/" title="Início">Início</a>
        |
        <a href="<?php echo Util::caminho_projeto(); ?>/admin/logoff.php" title="Log out">Log out</a>
    </div>
</div>