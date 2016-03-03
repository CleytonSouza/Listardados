<?php
ini_set('default_charset','UTF-8');
  
  mysql_connect('localhost', 'root', '');
  mysql_select_db('');
  mysql_query("SET CHARACTER SET 'utf8'"); 

?>


<html content="text/html; charset=utf-8" lang="en">
<head>
     <title>Relatorio</title>
     <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
    
    <!--CSS Link    -->
  <link rel="stylesheet" type="text/css" href="css/estilo.css">

  <script>
  $(function() {
    $( "#datepicker1" ).datepicker({
       dateFormat : 'yy-mm-dd 00:00:00',
       monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
       dayNamesShort: ['Dom', 'Seg', 'Ter'  , 'Quar', 'Qui', 'Sex', 'Sab'],
       dayNamesMin: ['Dom', 'Seg', 'Ter'  , 'Quar', 'Qui', 'Sex', 'Sab']
     });
    
  });
  </script>

<script>
 $(function() {
    $( "#datepicker2" ).datepicker({
      dateFormat : 'yy-mm-dd 00:00:00',
       monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
       dayNamesShort: ['Dom', 'Seg', 'Ter'  , 'Quar', 'Qui', 'Sex', 'Sab'],
       dayNamesMin: ['Dom', 'Seg', 'Ter'  , 'Quar', 'Qui', 'Sex', 'Sab']
  });
  });
  </script> 

</head>


<br/>

<form action="" method="POST"> 
   <div align="center"> 
       <strong>Data : 
             <tr>
                <td width="212" height="31" align="right">Inicial</td>
                <td colspan="2" ><input name="datainicio" type="text" id="datepicker1" size="15"  /></td>
                <td  type="button"  />
              <tr>    
         
            <tr>
                <td width="212" height="31" align="right">Final</td>
                <td colspan="2" ><input name="datafinal" type="text" id="datepicker2" size="15" /></td>
            <tr>   
              
            <tr>
                <td>
                   <button type="submit" name="Enviar" value="Enviar" class="btn btn-primary btn-sm" >Gerar</button>
                   <button type="submit" name="listar" value="listar" class="btn btn-primary btn-sm" >Listar Informações</button>
               <td>
            <tr>

    </div>
     <br/>
</form>
<?php   
  
function Pesquisar() {

  if (isset($_POST['listar'])) {

   
   $ini = $_POST["datainicio"];
   $fim = $_POST["datafinal"];
   
   //consulta pesquisa
   $sql = "SELECT * FROM natura_postagem where ts_impressao between '$ini' AND '$fim' ORDER BY track_post  ASC";
   $results = mysql_query($sql)or die (mysql_error());
   

   $data = array();
   while ($linha = mysql_fetch_array($results)){
     if ($linha['ts_impressao'] <> '0000-00-00 00:00:00') $linha['ts_impressao'] = date("d/m/Y H:i:s ", strtotime($linha['ts_impressao']));
    
    foreach ($linha as &$l) 
    if ($l == '0000-00-00 00:00:00') $l = '---';
    
    $data[] = $linha;
     
  }
  
  return $data;

  }
}
?>
 <table class="table table-bordered table-striped">
    <thead>
        <tr style="color: #fff; background-color: #000;">
           <th style="color: #fff; background-color: #000;">Track_post</th>
            <th style="color: #fff; background-color: #000;">Remetente</th>
            <th style="color: #fff; background-color: #000;">Destinatário</th>
		    <th style="color: #fff; background-color: #000;">etiqueta</th>       
            <th style="color: #fff; background-color: #000;">servico</th>
            <th style="color: #fff; background-color: #000;">ts_impressao</th>
           
        </tr>
    </thead>
     <?php 
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $data = Pesquisar();
      if (!empty($data))
         foreach ($data as $el) {
            echo "\n<tr>";
          //echo "\n  <td><a href='/xampp/htdocs/aes/docs/carta/{$el['Track_carta']}.pdf' >{$el['Track_carta']}</a></td>";
            echo "\n  <td>{$el['track_post']}</td>";
            echo "\n  <td>{$el['p_nome']}</td>";
            echo "\n  <td>{$el['d_nome']}</td>";
            echo "\n  <td>{$el['etiqueta']}</td>";
             echo "\n  <td>{$el['servico']}</td>";
            echo "\n  <td>{$el['ts_impressao']}</td>";
            echo "\n</tr>";

 }
}
?>
</table>
</body>
<!--
<p> <a href="javascript:self.print()">Imprimir Relatório</a> </p> -->

</html>
