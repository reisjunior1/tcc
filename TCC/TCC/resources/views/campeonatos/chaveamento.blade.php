<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
<head>
    <meta charset="uft-8">
    <style>
        *, *:before, *:after {
  box-sizing: border-box;
}

body {
  min-width: 1200px;
  margin: 0;
  padding: 50px;
  color: black;
  font: 16px Verdana, sans-serif;
  background: #eee9dc;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

#wrapper {
  position: relative;
}

.branch {
  position: relative;
  margin-right: 250px;
}
.branch:before {
  content: "";
  width: 50px;
  border-top: 2px solid black;
  position: absolute;
  right: -100px;
  top: 50%;
  margin-top: 1px;
}

.entry {
  position: relative;
  min-height: 60px;
}
.entry:before {
  content: "";
  height: 100%;
  border-right: 2px solid black;
  position: absolute;
  right: -50px;
}
.entry:after {
  content: "";
  width: 50px;
  border-top: 2px solid black;
  position: absolute;
  right: -50px;
  top: 50%;
  margin-top: 1px;
}
.entry:first-child:before {
  width: 10px;
  height: 50%;
  top: 50%;
  margin-top: 2px;
  border-radius: 0 10px 0 0;
}
.entry:first-child:after {
  height: 10px;
  border-radius: 0 10px 0 0;
}
.entry:last-child:before {
  width: 10px;
  height: 50%;
  border-radius: 0 0 10px 0;
}
.entry:last-child:after {
  height: 10px;
  border-top: none;
  border-bottom: 2px solid black;
  border-radius: 0 0 10px 0;
  margin-top: -9px;
}
.entry.sole:before {
  display: none;
}
.entry.sole:after {
  width: 50px;
  height: 0;
  margin-top: 1px;
  border-radius: 0;
}

.label {
  display: block;
  min-width: 150px;
  padding: 5px 10px;
  line-height: 20px;
  text-align: center;
  border: 2px solid black;
  border-radius: 5px;
  position: absolute;
  right: 0;
  top: 50%;
  margin-top: -15px;
}
    </style>
    <title>Sumula PDF</title>
</head>
<body>
	<?php
		$i = 0;
		$nTimes = 8;
		$loop = floor($nTimes/4);
		$profundidade = log($nTimes,2);
		var_dump($profundidade);
		$aux[0] = 'timeCasa';
		$aux[1] = 'timeVisitante';
	?>
    <div id="wrapper">
        <span class="label">Vencedor</span>
        <div class="branch lv1">
				<div class="entry">
					<span class="label">{{isset($partidas[3]) ? $partidas[3][0][$aux[0]] : 'Vencedor'}}</span>
					<div class="branch lv2">
						<div class="entry">
							<span class="label">{{isset($partidas[2]) ? $partidas[2][0][$aux[0]] : 'Vencedor'}}</span>
							<div class="branch lv3">
								<div class="entry">
									<span class="label">{{isset($partidas[1]) ? $partidas[1][$i][$aux[0]] : 'Vencedor'}}</span>
								</div>
								<div class="entry">
									<span class="label">{{isset($partidas[1]) ? $partidas[1][$i][$aux[1]] : 'Vencedor'}}</span>
								</div>
							</div>
						<div class="entry">
							<span class="label">{{isset($partidas[2]) ? $partidas[2][1][$aux[1]] : 'Vencedor'}}</span>
						</div>
					</div>
				</div>
				<div class="entry">
					<span class="label">{{isset($partidas[3]) ? $partidas[3][0][$aux[1]] : 'Vencedor'}}</span>
        </div>
    </div>

<<<<<<< Updated upstream
    <div id="wrapper">
      <span class="label">Vencedor</span>
        <div class="branch lv1">
        @for ($r = 0; $r < $loop; $r++)
					<div class="entry">
						<span class="label">{{isset($partidas[1]) ? $partidas[1][0][$aux[0]] : 'Vencedor'}}</span>
					</div>
				@endfor
            </div>
        </div>
    </div>    
=======
	<hr>
	<hr>

    <div id="wrapper">
		<span class="label">Vencedor</span>
        <div class="branch">
    		<div class="entry">
            	<span class="label">{{'Vencedor1'}}</span>
          	</div>
          	<div class="entry">
            	<span class="label">{{'Vencedor2'}}</span>
            	<div class="branch">
          			<div class="entry">
            			<span class="label">{{'Vencedor21'}}</span>
          			</div>
          			<div class="entry">
            			<span class="label">{{'Vencedor22'}}</span>

						<div class="branch">
          					<div class="entry">
            					<span class="label">{{'Vencedor221'}}</span>
          					</div>
          					<div class="entry">
            					<span class="label">{{'Vencedor222'}}</span>
								<div class="branch">
									<div class="entry">
										<span class="label">{{'Vencedor2221'}}</span>
									</div>
									<div class="entry">
										<span class="label">{{'Vencedor2222'}}</span>
									</div>
								</div>
          					</div>
        				</div>
          			</div>
        		</div>
        	</div>
    	</div>
    </div>

	<hr>
	<hr>


    <div id="wrapper">
		<span class="label">Vencedor</span>
        <div class="branch">

			<div class="entry">
				<span class="label">{{'Vencedor1'}}</span>
				<div class="branch">
					<div class="entry">
						<span class="label">{{'Vencedor2221'}}</span>
						<div class="branch">
							<div class="entry">
								<span class="label">{{'Vencedor2221'}}</span>
								<div class="branch">
									<div class="entry">
										<span class="label">{{'Vencedor2221'}}</span>
									</div>
									<div class="entry">
										<span class="label">{{'Vencedor2222'}}</span>
									</div>
								</div>
							</div>
							<div class="entry">
								<span class="label">{{'Vencedor2222'}}</span>
								<div class="branch">
									<div class="entry">
										<span class="label">{{'Vencedor2221'}}</span>
									</div>
									<div class="entry">
										<span class="label">{{'Vencedor2222'}}</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="entry">
						<span class="label">{{'Vencedor2222'}}</span>
						<div class="branch">
							<div class="entry">
								<span class="label">{{'Vencedor2221'}}</span>
								<div class="branch">
									<div class="entry">
										<span class="label">{{'Vencedor2221'}}</span>
									</div>
									<div class="entry">
										<span class="label">{{'Vencedor2222'}}</span>
									</div>
								</div>
							</div>
							<div class="entry">
								<span class="label">{{'Vencedor2222'}}</span>
								<div class="branch">
									<div class="entry">
										<span class="label">{{'Vencedor2221'}}</span>
									</div>
									<div class="entry">
										<span class="label">{{'Vencedor2222'}}</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="entry">
				<span class="label">{{'Vencedor2'}}</span>
				<div class="branch">
					<div class="entry">
						<span class="label">{{'Vencedor2221'}}</span>
						<div class="branch">
							<div class="entry">
								<span class="label">{{'Vencedor2221'}}</span>
								<div class="branch">
									<div class="entry">
										<span class="label">{{'Vencedor2221'}}</span>
									</div>
									<div class="entry">
										<span class="label">{{'Vencedor2222'}}</span>
									</div>
								</div>
							</div>
							<div class="entry">
								<span class="label">{{'Vencedor2222'}}</span>
								<div class="branch">
									<div class="entry">
										<span class="label">{{'Vencedor2221'}}</span>
									</div>
									<div class="entry">
										<span class="label">{{'Vencedor2222'}}</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="entry">
						<span class="label">{{'Vencedor2222'}}</span>
						<div class="branch">
							<div class="entry">
								<span class="label">{{'Vencedor2221'}}</span>
								<div class="branch">
									<div class="entry">
										<span class="label">{{'Vencedor2221'}}</span>
									</div>
									<div class="entry">
										<span class="label">{{'Vencedor2222'}}</span>
									</div>
								</div>
							</div>
							<div class="entry">
								<span class="label">{{'Vencedor2222'}}</span>
								<div class="branch">
									<div class="entry">
										<span class="label">{{'Vencedor2221'}}</span>
									</div>
									<div class="entry">
										<span class="label">{{'Vencedor2222'}}</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


>>>>>>> Stashed changes
</body>
</html>