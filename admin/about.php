<?php 
	include('../includes/constants.php'); 
	include('../includes/adminheader.php'); 
?>
<link rel="stylesheet" href="../styles/dev.css">
<head>
	<title>Marketplace Administration</title>
	<link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/3050/3050209.png" type="image/png">
</head>
<?php
	if (isset($_SESSION["usersName"])){

	}
	else{
		header("location: ../index.php");
		exit();
	}
?>
<body>
    <?php
        // Parent class
        abstract class Profile {
            public $name;
            public $status;
            public $prog;
            public $motto;
            public function __construct($name, $status, $prog, $motto) {
                $this->name = $name;
                $this->status = $status;
                $this->prog = $prog;
                $this->motto = $motto;
            }
            abstract public function name() : string; 
            abstract public function status() : string; 
            abstract public function prog() : string; 
            abstract public function motto() : string; 
        }

        // Child classes
        class Dev extends Profile {
            public function name() : string {
                return "$this->name"; 
            }
            public function status() : string {
                return "$this->status"; 
            }
            public function prog() : string {
                return "$this->prog";  
            }
            public function motto() : string {
                return "$this->motto"; 
            }
        }


        // Create objects from the child classes
        $ic = new Dev("Ivann Benedict V. Calandria", "Happily Taken", "Web Development", "Eat & Sleep");
        $kg = clone $ic;
        $kg->name = "Kevin Eugene Allan C. Gojocco";
        $kg->status = "Single and Ready to Mingle";
        $kg->motto = "Isip Ivann Isip";

    ?>
    <div class="maincontent">
        <div class="welcome">
            <h1>Introducing the Developers</h1>
        </div>
        <div class="wrapper">
            <div class="column">
                <div class="card">
                    <img src="https://scontent.fmnl25-2.fna.fbcdn.net/v/t1.6435-9/122009381_2511617149137063_8412984241065615983_n.jpg?_nc_cat=104&ccb=1-5&_nc_sid=174925&_nc_ohc=Y1u4YFlyEgcAX-ol90r&_nc_ht=scontent.fmnl25-2.fna&oh=e56abee25a189ca6f141498b63c494d3&oe=61B4C04C" alt="IC" width="100%" height="250">
                    <h4><?php echo $ic->name();?></h4>
                    <p><?php echo $ic->status();?></p>
                    <p><?php echo $ic->prog();?></p>
                    <p><?php echo $ic->motto();?></p>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <img src="https://scontent.fmnl25-1.fna.fbcdn.net/v/t1.6435-9/83272709_2938541652855328_4475175907467722752_n.jpg?_nc_cat=100&ccb=1-5&_nc_sid=174925&_nc_ohc=U-C5ERTkor8AX8OFH_G&_nc_ht=scontent.fmnl25-1.fna&oh=79c1529598d87976944feb686f59e75d&oe=61B4E3D2" alt="KG" width="100%" height="250">
                    <h4><?php echo $kg->name();?></h4>
                    <p><?php echo $kg->status();?></p>
                    <p><?php echo $kg->prog();?></p>
                    <p><?php echo $kg->motto();?></p>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <img src="https://scontent.fmnl25-2.fna.fbcdn.net/v/t1.6435-9/40443741_113216659630896_2261021198664073216_n.jpg?_nc_cat=106&ccb=1-5&_nc_sid=174925&_nc_ohc=h-a1PyX_uBgAX-6cA1q&_nc_ht=scontent.fmnl25-2.fna&oh=7227b68efc11de44b812b44d4f1cb7d8&oe=61B85425" alt="KD" width="100%" height="250">
                    <h4>Karl Anjelo D. Pastrana</h4>
                    <p>It's Complicated</p>
                    <p>Web Development</p>
                    <p>Quote/Motto</p>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <img src="https://scontent.fmnl25-1.fna.fbcdn.net/v/t1.6435-9/138673926_2681863058790569_2069149022945706770_n.jpg?_nc_cat=107&ccb=1-5&_nc_sid=174925&_nc_ohc=dAD3YNEOY70AX-YUiG1&_nc_ht=scontent.fmnl25-1.fna&oh=7ed958dba80d62f5dab2deb8801c2da4&oe=61B76720" alt="JS" width="100%" height="250">
                    <h4>Joshua Jose D. Sapalaran</h4>
                    <p>Happily Taken</p>
                    <p>Web Development</p>
                    <p>Quote/Motto</p>
                </div>
            </div>
        </div>
    </div>
</body>