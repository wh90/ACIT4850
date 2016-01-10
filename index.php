<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if(!isset($_GET['board']))
        {
            $link = './?board=---------';
            echo '<a href="'.$link.'">Start Game</a><br/>';
        }
        
        echo "Tic Tac Toe by Wilson Hoy";
        $position = $_GET['board'];
        $squares = str_split($position);
 
        $game = new Game($squares);
        $game->display();
        if ($game->winner('x'))
            echo 'x wins.';
        else if ($game->winner('o'))
            echo 'o wins.';
        else
            echo 'No winner yet.';
        
        
        class Game{
            var $position;
             
            function __construct($squares){
                $this->position = $squares;
            }
            
            function winner($token) {
                $won = false;
                
                for($row = 0 ; $row < 3; $row++)
                {
                    if(($this->position[$row * 3] == $token) && ($this->position[($row * 3) + 1] == $token) && ($this->position[($row * 3) + 2] == $token))
                        $won = true;
                }
                
                for($col = 0; $col < 3 ; $col++)
                {
                    if(($this->position[$col] == $token) && ($this->position[$col + 3] == $token) && ($this->position[$col + 6] ==$token))
                        $won = true;
                }
                
                if (($this->position[0] == $token) &&
                        ($this->position[4] == $token) &&
                        ($this->position[8] == $token)) {
                    $won = true;
                } else if (($this->position[2] == $token) &&
                        ($this->position[4] == $token) &&
                        ($this->position[6] == $token)) {
                    $won = true;
                }
                return $won;
            }
            
            function display()
            {
                echo '<table cols="3" style="font-size:large;font-weight:bold">';
                echo '<tr>'; // open the first row
                for ($pos = 0; $pos < 9; $pos ++)
                {
                    echo $this->show_cell($pos);
                    if($pos %3 == 2) echo '</tr><tr>'; // start a new row for the next square
                }
                echo '</tr>';
                echo '</table>';
                
            }
            
            function show_cell($which)
            {
                $token = $this->position[$which];
                //deal with the easy case
                if($token <> '-') return '<td>'.$token.'</td>';
                //now the hard case
                $this->newposition = $this->position; // copy the original
                $move = implode($this->newposition); 
                $this->newposition[$which] = $this->pick_move($move);
                $move = implode($this->newposition); //make a string from the board array
                 //this would be their move
                $link = './?board='.$move; //this is what want the link to be
                // so return a cell containing an anchor and showing a hyphen
                return '<td><a href="'.$link.'">-</a></td>';
                
            }
            
            function pick_move($move)
            {
                $board = str_split($move);
                $xpieces = 0 ;
                $opieces = 0 ;       
                foreach($board as $piece)
                {
                    if($piece == 'x')
                    {
                        $xpieces ++;
                    }
                    else if ($piece == 'o')
                    {
                        $opieces ++;
                    }
                    
                }
                
                if($xpieces > $opieces)
                    return 'o';
                else if ($xpieces < $opieces)
                    return 'x';
                else if ($xpieces == $opieces)
                    return 'x';
                
                return 'x';
            }
        }
        
        ?>
		
		
	</body>
</html>