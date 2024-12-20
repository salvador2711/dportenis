<?php 
namespace MyApp\Views;


class BaseView
{
    public function header()
    {
        echo '<html>';
        echo '<head>';
        echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">';
        echo '<title>dportenis</title>';
        echo '</head>';
        echo '<body>';
    }

    public function footer()
    {
        echo '</body>';
        echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>';
        echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>';
        echo '</html>';
    }

    public function headerdetalle()
    {
        echo '<style>
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
        .body
        {
            padding:10px;
        }

        </style>';
    }
}
