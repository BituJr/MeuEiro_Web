<?php session_start();

function ActiveClass($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
        echo 'class="active"';
}
		if (!isset($_SESSION['UserId'])) {
			header ('Location: login.php');
			exit;
		}

		if (isset($_GET['action'])) {
			$action = $_GET['action'];
			if ($action == 'logout') {
				session_destroy();
				header('Location: login.php');
			}
		}

if (isset($_GET['page']) && $_GET['page'] == 'Transacao') {
            $page = 'Transacao';
        } else if (isset($_GET['paginas']) && $_GET['paginas'] == 'RelatorioReceita') {
            $page = "RelatorioReceita";
        } else if (isset($_GET['paginas']) && $_GET['paginas'] == 'Orcamento') {
            $page = "Orcamento";
        } else if (isset($_GET['paginas']) && $_GET['paginas'] == 'CategoriaReceita') {
            $page = "CategoriaReceita";
		} else if (isset($_GET['paginas']) && $_GET['paginas'] == 'Receitas') {
            $page = "Receitas";
        } else if (isset($_GET['paginas']) && $_GET['paginas'] == 'CategoriaDespesa') {
            $page = "CategoriaDespesa";
		} else if (isset($_GET['paginas']) && $_GET['paginas'] == 'Despesas') {
            $page = "Despesas";
        } else if (isset($_GET['paginas']) && $_GET['paginas'] == 'Contas') {
            $page = "Contas";
        } else if (isset($_GET['paginas']) && $_GET['paginas'] == 'GerenciarReceitas') {
            $page = "GerenciarReceitas";
        } else if (isset($_GET['paginas']) && $_GET['paginas'] == 'Configuracoes') {
            $page = "Configuracoes";
        } else if (isset($_GET['paginas']) && $_GET['paginas'] == 'RelatorioDespesa') {
            $page = "RelatorioDespesa";
        } else if (isset($_GET['paginas']) && $_GET['paginas'] == 'GerenciarDespesas') {
            $page = "GerenciarDespesas";
        } else if (isset($_GET['paginas']) && $_GET['paginas'] == 'ReceitaVsDespesa') {
            $page = "ReceitaVsDespesa";
        } else if (isset($_GET['paginas']) && $_GET['paginas'] == 'CalendarioReceitas') {
            $page = "CalendarioReceitas";   
        } else if (isset($_GET['paginas']) && $_GET['paginas'] == 'CalendarioDespeseas') {
            $page = "CalendarioDespeseas";
        }  else {
            $page = 'dashboard';
        }


include('includes/global.php');


include('includes/header.php'); 

$msgBox	="";

if (file_exists('paginas/'.$page.'.php')) {
           
            include('paginas/'.$page.'.php');
        } else {
           
          
            echo '
                    <div class="wrapper">
                        <h3>Err</h3>
                        <div class="alertMsg default">
                            <i class="icon-warning-sign"></i> The page "'.$page.'" could not be found.
                        </div>
                    </div>
                ';
        }

        include('includes/footer.php');
  

?>
