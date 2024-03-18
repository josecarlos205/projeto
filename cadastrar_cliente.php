<?php 

    function limpar_texto($str){ 
        return preg_replace("/[^0-9]/", "", $str); 
    }



    if(count($_POST)>0){
        include('conexao.php');
        $erro = false;
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $nascimento = $_POST['nascimento'];

        if(empty($nome)) {
            $erro = "Preencha o nome";
        }
        if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erro = "Preencha o e-mail";
        }
        
        if(!empty($nascimento)){
            //25/08/1965
            //array(1965, 08, 25)
            //1965-08-25
            $pedacos = explode('/', $nascimento);
            if(count($pedacos) ==3) {
                $nascimento =implode('-', array_reverse($pedacos));              
            } else {
                $erro = "A data de nascimento deve seguir o padrão (dia/mes/ano)";
            }
        }

        if(!empty($telefone)) {
            $telefone = limpar_texto($telefone);
            if(strlen($telefone) !=11)
                $erro = "O telefone deve ser preenchido no padrão (43) 98888-8888";
        }
        if($erro) {
            echo "<p><b>Erro: $erro</b></p>";
        }else{
            $sql_code = "INSERT INTO clientes (nome, email, telefone, nascimento, data) VALUES ('$nome', '$email', '$telefone', '$nascimento', NOW())";
            $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
            if($deu_certo) {
                echo "<p><b>Cliente cadastrado com sucesso !!</b></p>";
                unset($_POST);
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
</head>
<body>
    <form method="POST" action="">
        <p>
            <label>Nome............................:</label>
            <input value="<?php if(isset($_POST['nome'])) echo $_POST['nome']; ?>" name="nome" type="text">
        </p>
        <p>
            <label>E-mail...........................:</label>
            <input value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" name="email" type="text">
        </p>
        <p>
            <label>Data de Nascimento.....:</label>
            <input value="<?php if(isset($_POST['nascimento'])) echo $_POST['nascimento']; ?>"  name="nascimento" type="text">
        </p>
        <p>
            <label>Telefone........................:</label>
            <input value="<?php if(isset($_POST['telefone'])) echo $_POST['telefone']; ?>" placeholder="(43) 98888-8888" name="telefone" type="text">
        </p>
        <p>
        <button type="submit">Salvar Cliente</button>
        </p>
        <p>
            <a href="clientes.php">Voltar para a lista</a>
        </p>
    </form>

    
</body>
</html>