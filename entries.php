<!DOCTYPE html>
<?php
    include('controller/dataFilterHandler.php');
    // $proteinType = $_POST['proteinType'];
    // $evidenceLevel = $_POST['evidenceLevel'];
    // $taxonomy = $_POST["taxonomy"];
    ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>My Project</title>
    <link type="text/css" rel="stylesheet" href="css/dataTables/dataTables.bootstrap.css">
    <link type="text/css" rel="stylesheet" href="css/dataTables/jquery.dataTables.css">
        <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="js/Chart.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="html5shiv.js"></script>
        <script src="respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <!-- Navigation -->
    <?php include_once('menu.php');
    if(!isset($_SESSION['peptide']) && !isset($_SESSION['proteinType'])){ 
    $_SESSION['peptide'] = $_POST['peptide'];
    $_SESSION['proteinType'] = $_POST['proteinType'];
    $_SESSION['evidenceLevel'] = $_POST['evidenceLevel'];
    $_SESSION['taxonomy'] = $_POST['taxonomy'];
    }
    ?>
    <!-- Page Content -->
    <div class="container">
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Data Entries</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active">Entries</li>
                </ol>
                <?php if(isset($_SESSION['peptide'], $_SESSION['proteinType'], $_SESSION['evidenceLevel'], $_SESSION['taxonomy'])) { ?>
                <ol class="breadcrumb">
                    <li class="active">Signal Peptide : <?php print_r($_SESSION['peptide']);?></li>
                    <?php 
                    if($_SESSION['proteinType'] != 'None')
                    { ?>
                    <li class="active">Protein Type : <?php print_r($_SESSION['proteinType']);?></li>
                    <?php 
                    } if($_SESSION['evidenceLevel'] != 'None'){ 
                    ?>
                    <li class="active">Evidence Level :<?php print_r($_SESSION['evidenceLevel']);?></li>
                    <?php 
                    } if($_SESSION['taxonomy'] != 'None'){ ?>
                    <li class="active">Taxonomy : <?php print_r($_SESSION['taxonomy']);?></li>
                    <?php }if($_GET['filter'] == 'default'){ ?>
                    <li class="active">Filter : Original Entries</li>
                    <?php }if($_GET['filter'] == 1){ ?>
                    <li class="active">Filter : Data Sets with Signal Peptide</li>
                    <?php }if($_GET['filter'] == 2){ ?>
                    <li class="active">Filter : Functions</li>
                    <?php }if($_GET['filter'] == 3){ ?>
                    <li class="active">Filter : Transmembranes</li>
                    <?php }if($_GET['filter'] == 4){ ?>
                    <li class="active">Filter : Non-Transmembranes</li>
                    <?php } ?>
                </ol>
                <?php } ?>
                <?php
                $tempval = $_GET['filter'];
                 switch ($tempval) {
                    case 1:
                        $filter = 'entries?filter=1';
                        break;
                    case 2:
                        $filter = 'entries?filter=2';
                        break;
                    case 3:
                        $filter = 'entries?filter=3';
                        break;
                    case 4:
                        $filter = 'entries?filter=4';
                        break;
                    default:
                        $filter = 'entries?filter=default';
                        break;
                }
                ?>
                 
                <form>
                    <select name="URL" class="filter" id="filter" onchange="window.location.href=this.form.URL.options[this.form.URL.selectedIndex].value">
                        <option value="entries?filter=default">Original Entries</option>
                        <option value="entries?filter=1">Data Sets with Signal Peptide</option>
                        <option value="entries?filter=2">Functions</option>
                        <option value="entries?filter=3">Transmembranes</option>
                        <option value="entries?filter=4">Non-Transmembranes</option>
                    </select>
                    <input type="hidden" id="filter_temp" value="<?php echo $filter;?>">
                    <a href="#" data-toggle="modal" data-target="#recordChart" class="btn btn-info btn-sm" data-title="Chart">Show Chart</a>
                </form>
                <div class="main-content">
                    <div class="list-container">
                        <div class="table-responsive">
                            <table class="table table-bordered datatable display" id="resultTable">
                                <thead>
                                    <tr>
                                        <?php                                        
                                        if($_SESSION['filter'] == 1){
                                            echo '<th>Entry ID</th>
                                                <th>Entry Name</th>
                                                <th>Subcellular Location</th>
                                                <th>Organism</th>
                                                <th>Sequence Length</th>';
                                        }
                                        elseif($_SESSION['filter'] == 2){
                                            echo '<th>Entry ID</th>
                                                <th>Entry Name</th>
                                                <th>Functions</th>';
                                        }
                                        elseif($_SESSION['filter'] == 3){
                                            echo '<th>Entry ID</th>
                                                <th>Entry Name</th>
                                                <th>Segment Type</th>
                                                <th># of Segments</th>
                                                <th>Topology Orientation</th>
                                                <th>Sequence Length</th>';
                                        }
                                        elseif($_SESSION['filter'] == 4){
                                            echo '<th>Entry ID</th>
                                                <th>Entry Name</th>
                                                <th>Secretory</th>
                                                <th>Location</th>';
                                        }else{
                                            echo '<th>Entry ID</th>
                                            <th>Entry Name</th>
                                            <th>Sequence Length</th>';
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $data = $dataFilter->fetchData();                               
                                    ?>
                                    <?php
                                    foreach ($data as $key) {
                                          $id = $key['entry_ID'];
                                          $name = $key['entry_name'];
                                          $length = $key['sequence_length'];
                                          $location = $key['subcellular_location'];
                                          $organism = $key['taxonomic_lineage']; //$key['organism']
                                          $function = 'Bind to actin and affects the structure of the cytoskeleton. At high concentrations, profilin prevents the polymerization of actin, whereas it enhances it at low concentrations. By binding to PIP2...'; //$key['function']
                                          $segment = 'n'; //$key['segment_type']
                                          $num_segment = 'b'; //$key['segment_num']
                                          $topology = 'v' ; //$key['topology']
                                          $secretory = 'x'; //$key['secretory']
                                    ?>
                                    <?php
                                    if($_GET['filter'] == 'default'){
                                    ?>
                                    <tr>
                                    <td>

                                        <a href="#" data-toggle="modal" data-target="#recordInfo" data-title="Record Information">Entry ID <?php echo $id;?></a>

                                    </td>
                                    <td><?php echo $name;?></td>
                                    <td><?php echo $length;?></td>
                                    </tr> 
                                    <?php } ?>
                                    <?php
                                    if($_GET['filter'] == 1){
                                    ?>
                                    <tr>
                                    <td>

                                        <a href="#" data-toggle="modal" data-target="#recordInfo" data-title="Record Information">Entry ID <?php echo $id;?></a>

                                    </td>
                                    <td><?php echo $name;?></td>
                                    <td><?php echo $location;?></td>
                                    <td><?php echo $organism;?></td>
                                    <td><?php echo $length;?></td>
                                    </tr> 
                                    <?php } ?>
                                    <?php
                                    if($_GET['filter'] == 2){
                                    ?>
                                    <tr>
                                    <td>

                                        <a href="#" data-toggle="modal" data-target="#recordInfo" data-title="Record Information">Entry ID <?php echo $id;?></a>

                                    </td>
                                    <td><?php echo $name;?></td>
                                    <td><?php echo $function;?></td>          
                                    </tr> 
                                    <?php } ?>
                                    <?php
                                    if($_GET['filter'] == 3){
                                    ?>
                                    <tr>
                                    <td>

                                        <a href="#" data-toggle="modal" data-target="#recordInfo" data-title="Record Information">Entry ID <?php echo $id;?></a>

                                    </td>
                                    <td><?php echo $name;?></td>
                                    <td><?php echo $segment;?></td>
                                    <td><?php echo $num_segment;?></td>  
                                    <td><?php echo $topology;?></td>
                                    <td><?php echo $length;?></td>          
                                    </tr> 
                                    <?php } ?>
                                    <?php
                                    if($_GET['filter'] == 4){
                                    ?>
                                    <tr>
                                    <td>

                                        <a href="#" data-toggle="modal" data-target="#recordInfo" data-title="Record Information">Entry ID <?php echo $id;?></a>

                                    </td>
                                    <td><?php echo $name;?></td>
                                    <td><?php echo $secretory;?></td>
                                    <td><?php echo $location;?></td>                                             
                                    </tr> 
                                    <?php } ?>
                                    <?php
                                        }
                                    ?>                                                          
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>            
       <!-- /.row -->
        <!-- Dialog box --->
        <!-- Chart Information -->
        <?php include('entries_chart.php'); ?>      
        <!-- end Chart Information -->
        <!-- end Record Information -->
        <!-- end Dialog box-->
        <hr>
        <!-- Footer -->
        <?php include_once('footer.php'); ?>
    </div>
    <!-- Record Information -->
        <?php include('entry_detail.php'); ?>
    <!-- /.container -->
    <!-- /.container -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/dataTables/dataTables.js"></script>
    <script type="text/javascript" src="js/dataTables/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="js/dataTables/jquery.dataTables.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#resultTable').dataTable({          
            });
            var filter = $('#filter_temp').val();
            $('#filter  option[value="'+filter+'"]').attr("selected",true);
        });
    </script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

