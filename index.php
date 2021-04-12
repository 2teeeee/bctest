<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Blockchain</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">


        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>

    </head>
    <body class="">
        
        <?php 
        $res = null;

        if(isset($_GET['code'])){

            $code = $_GET['code'];
        
            $url = "https://blockchain.info/rawtx/".$code;

            $response = file_get_contents($url);
            $res = json_decode($response);

        }


        ?>

        <div class="container">
            <form method="GET" action="index.php">
               

                <div class="row mt-2">
                    <div class="form-group col-sm-12">
                        <textarea id="code" rows="2" placeholder="tid" class="form-control" name="code"><?php echo $res?$res->hash:''; ?></textarea>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="form-group mb-0 text-align-left">
                            <button type="submit" class="btn btn-success float-left">
                                check
                            </button>
                    </div>
                </div>

                <?php if($res){ ?>
                <div class="row border border-succcess p-2 rounded mt-2">
					<table class="table table-striped">
				  		<tbody>
						<tr>
						  <th scope="row">source</th>
						  <td>
							<?php 
							foreach($res->inputs as $inp) {
								echo $inp->prev_out->addr." => ".($inp->prev_out->value/100000000)."BTC <br/>";
							}
                            ?>
							</td>
						</tr>
						<tr>
						  <th scope="row">destination</th>
						  <td>

                            <?php 
							  foreach($res->out as $out) {
                        		echo $out->addr." => ".($out->value/100000000)." BTC<br/>";
                    			}
                                ?>
							</td>
						</tr>
						<tr>
						  	<th scope="row">confirmation</th>
						  	<td>
							<?php echo $res->block_index?"Confirmed":"unConfirmed"; ?>
							</td>
						</tr>
					  </tbody>
					</table>
					
                </div>
                    <?php } ?>

            </form>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

    </body>
</html>
