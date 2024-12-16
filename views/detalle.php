<?php 

include 'header.php';
include_once './controllers/menuController.php';
$menuC=new menuController();
if(isset($dataMenu))
{
?>	
    <style>
    #menu ul 
    {
        list-style:none;
    }

    #menu ul li 
    {
        background-color:#2e518b;
    }

    #menu ul a 
    {
        display:block;
        color:#fff;
        text-decoration:none;
        font-weight:400;
        font-size:15px;
        padding:10px;
    }

    #menu ul a.active{
        background-color: #4CAF50;
        color: white;
    }

    #menu ul li 
    {
        position:relative;
        float:left;
    }

    #menu ul li:hover 
    {
        background:#5b78a7;
    }

    #menu ul ul 
    {
        display:none;
        position:absolute;
        top:100%;
        left:0;
        background:#eee;
        padding:0;
    }

    #menu ul ul li {
        float:none;
        width:150px
    }

    #menu ul ul a {
        line-height:120%;
        padding:10px 15px;
    }

    #menu ul li:hover > ul {
        display:block;
    }

    </style>
    <?php if(sizeof($parents)>0)
        {
    ?>
    <nav id="menu">
    
        <ul>
        <?php
            foreach($parents as $p)
            {
        ?>
            <li>
                <a href="#"><?php echo $p["nameParent"];?>
                <?php 
                    $submenus=$menuC->getHijos($p["idParentM"]);    
                    if(sizeof($submenus)>0)
                    {
                    ?>
                    <ul>
                        <?php 
                        foreach($submenus as $s)
                        {
                        ?>
                            <li><a href="#"><?php echo $s["nameM"];?></a></li>
                        <?php 
                        }
                        ?>
                    </ul>
                    <?php        
                    }
                    ?>
            </a>
        <?php
        } 
        ?>
        </li>

        
    <?php }
    ?>
    </ul>
    </nav>

    
        <br>
        <br>
        <br>

		
            <h2> <?php echo $dataMenu['DescriptionM'];?>
            </h2>
        <br>
        <br>
        <a class="btn btn-outline-danger" href="home">Regresar</a>
            
	<?php include 'footer.php'; }
    else
    {
        echo "<h2>No existe información del menu</h2>";
    }
    ?>

 
