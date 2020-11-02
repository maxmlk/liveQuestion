<?php
    // page précédente

    echo'<nav class="nav bg-light">
        <p><a href="';
        if($_GET['page'] > 1){
            echo'les_questions.php?page='.($_GET['page'] - 1);
        }
        echo'" class="prev">«</a></p>';

        // numéros de page

        for ($i=0; $i < count($question)/$nb_questions; $i++){
            if($_GET['page'] == ($i+1)){
                echo'<p class="page"><b><a href="les_questions.php?page='.($i+1).'">'.($i+1).'</a></b></p>';
            }
            else{
                echo'<p class="page"><a href="les_questions.php?page='.($i+1).'">'.($i+1).'</a></p>';
            }
        }

        // page suivante

        echo'<p><a href="';
        if($_GET['page'] < count($question)/$nb_questions){
            echo'les_questions.php?page='.($_GET['page'] + 1);
        }
        echo'" class="next">»</a></p>
    </nav>';
?>