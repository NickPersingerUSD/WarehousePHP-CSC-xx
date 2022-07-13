"use strict";   //forces declaration of the scope of names
let gameWon = false;
let gameOver = false;

//shuffles the 2D array after initializing the total correct amount and ratio of crates
function shuffleArray(arr, n) { 
    for (let y = 0; y < n; y++) {
        for (let x = 0; x < n; x++){
        var j = Math.floor(Math.random() * n);
        var k = Math.floor(Math.random() * n);
        var temp = arr[y][x];
        arr[y][x] = arr[j][k];
        arr[j][k] = temp;
        
    }
}
}


//grabs random indices and adds 5 to the weight of a crate
function createTarget(b, n, tgt){
    let index1 = Math.floor(Math.random() * (n-2) +1); // random row within constraints
    let index2 = Math.floor(Math.random() * (n-2) +1); // random column within constraints
    b[index1][index2] = "◉";
    //b[index1][index2] = "⊗";
    tgt.push(index1);
    tgt.push(index2);
    
    return tgt;
}

function createExit(b, bobStart){
    console.log(bobStart);
    b[bobStart[0]][bobStart[1]] =   "!";
    return;
    
}

//Game is a constructor for a game board. 
//A game has a rectangular arrary of crateweights and a location for the bobcat that pushes them around.
//            it has methods move(dir)  to move the bobcat around,
//                            toString to show the gameboard as formatted text

//this version requires execution in an html file containing a div with id "myText" for displaying 
let Game = function () {  //THIS IS A CONSTRUCTOR FOR A GAME OBJECT it must be called us new
    //private game data
    let n = parseInt(Math.random()*5) + 8;     //number of rows and columns    
    let b = [ ];      //initb (below) initializes to random weights and n x n
    let bob = { };    //the bob has a row,column, and direction (use 0=North,1=E,2=S,3=W)
    let tgt = [ ];
    let arr = new Array(n);
    let zero = Math.floor((n*n)/2+1);
    let one = Math.floor((n*n)/4+1);
    let two = Math.floor((n*n)/8+1);
    let three = Math.floor((n*n)/8+1);
    let bobStart = [ ];
    let bobDir;
    var score = 0;
    var moves = 0;
    
    
    //============ this is temporary. replace it with randomized initialization ===========
    //creates a 2d array with the specified number of crates and weights
    for (let i = 0; i < n; i++){
        arr[i] = new Array(n);
    }
    for (let y = 0; y < n; y++){   
        for (let x = 0; x < n; x++){
            if (zero > 0){
                arr[y][x] = 0;
                zero--;
            }
            if (zero == 0 && one > 0){
                arr[y][x] = 1;
                one--;
            }
            if (zero == 0 && one == 0 && two > 0){
                arr[y][x] = 2;
                two--;
            } 
            if (zero == 0 && one == 0 && two == 0 && three > 0){
                arr[y][x] = 3;
                three--;
            }
         }
        }

    shuffleArray(arr, n);
    b = arr;
    //b = arr;
    //createExit(b, bob);
    //createExit(b, bobStart);
    
     bob.r=n-1; bob.c=Math.floor(Math.random() * n); bob.d=0;  //headed north
     b[bob.r][bob.c] = 9;
     let startRowIndex = bob.r;
     let startColumnIndex = bob.c;
     
     bobStart = [startRowIndex,startColumnIndex];
     
     createTarget(b, n, tgt);
     //createExit(b, bobStart);
     b[bob.r][bob.c]=0;            //bob cannot start ontop of a crate
     //b[startRowIndex][startColumnIndex] = "H";
    //=====================================================================================
    
    // ===========  public methods  =================
    //Game.prototype.move = function (dirch){   is an alternative approach for a public method
    
    
    this.move = function(dirch){
        
        if (gameOver == true){
        return;
    }
        
        //dirch is converted to  0123 meaning NESW 
        let d=-1;
        if(dirch===87) d=0;   //w
        if(dirch===65) d=3;   //a
        if(dirch===83) d=2;   //s
        if(dirch===68) d=1;   //d
        if(dirch===88) d=4;   // for when x is pressed to explode
        
        if(d<0) return score;       //ignore bad keys
        
        let dr = [-1, 0, 1,  0];    //nesw
        let dc = [ 0, 1, 0, -1];
        

        if(d==4){
            if(bob.d==0 && b[bob.r-1][bob.c]!= 0){
                b[bob.r-1][bob.c] = 0;   //facing north and exploding crate in front
                score += 100;
                return score;
            }
            if(bob.d==1 && b[bob.r][bob.c+1]!= 0){
                b[bob.r][bob.c+1] = 0;   //facing east and exploding crate in front
                score += 100;
                return score;
            }
            if(bob.d==2 && b[bob.r+1][bob.c]!= 0){
                b[bob.r+1][bob.c] = 0;   //facing south and exploding crate in front
                score += 100;
                return score;
            }
            if(bob.d==3 && b[bob.r][bob.c-1]!= 0){
                b[bob.r][bob.c-1] = 0;   //facing west and exploding crate in front
                score += 100;
                return score;
            }
        }

        else if (d === bob.d) {   //move the bob one cell in its direction
            if (!((bob.r === n - 1 && d === 2) || (bob.r === 0 && d === 0) || (bob.c === n - 1 && d === 1) || (bob.c === 0 && d === 3) )) {
                if (slide(d)) {
                    score++;
                    bob.r = bob.r + dr[d]; bob.c = bob.c + dc[d];
                    if(tgt[0] === bobStart[0] && tgt[1] === bobStart[1]){
                        gameWon = true;
                        console.log("Target has arrived at the starting location!");
                        gameOver = true;
        
                }
            }
        }
        
        else if (d !== (bob.d+2)%4){  //90 degree pivot
            bob.d = d;
            score++;
        }
        return score;
    };
    
    
    let slide = function (d) {     //slides the crates & returns true (or returns false)
        
        if (gameOver == true){
        return;
    }
        
        let onbrd = function (r, c) {
            if (r > b.length - 1 || r < 0 || c > b.length - 1 || c < 0) {
                return false;
            }
            return true;
        };
        let allowedWt = 4;
        let dr = [-1, 0, 1, 0];    //nesw
        let dc = [0, 1, 0, -1];
        let i, rr, cc, w;
        let wt = 0;    //amount of wieght we are pushing
        for (i = 1; ; i++) {
            rr = bob.r + i * dr[d];
            cc = bob.c + i * dc[d];
            
            if (!onbrd(rr, cc) || wt + b[rr][cc] > allowedWt)
                return false;
            if (b[rr][cc] === 0)
                break;    //can slide them i squares
            wt = wt + b[rr][cc];
        }
        // now move the crates, starting at the final cell,  rr,cc
        for (let j = 0; j < i; j++) {   //slide the right number of  times
            
            let rprev = rr - dr[d]; let cprev = cc - dc[d];
            b[rr][cc] = b[rprev][cprev];
            if(rr === tgt[0] && cc === tgt[1]){
                tgt[0] = rr + dr[d];
                tgt[1] = cc + dc[d];
            }
            rr = rprev; cc = cprev;
        }
        
        return true;
    }  ;
    
    Game.prototype.toString = function(){  //public method of Game
        
        //createExit(b, bobStart);
        let out = "";
        let arr = [];
        for(let r=0; r<n; r++){
            for(let c=0; c<n; c++){
                if (arr[r] === tgt[0] && arr[c] === tgt[1]){
                   // out = "<span style=color:blue>" + out + :"</span>";
                  // out = out + "!";
                }
                if(r===bob.r && c===bob.c){
                    if     (bob.d===0) out = out + "^";
                    else if(bob.d===1) out = out + ">";
                    else if(bob.d===2) out = out + "v";
                    else               out = out + "<";
                }
                else  out = out + b[r][c];
            }
            out = out + "\n";
        }
      
        if (gameOver == true){
        return;
    }
        return "<pre>" + out + "</pre>";   //avoid browser formatting
    };
    
    this.gameScore = function(score, moves){   //show in existing div score  
        let inner = "<h1>Score: " + score +  "</h1>";    
        document.getElementById("score").innerHTML = inner;
        if (moves === 0){
            createExit(b, bobStart);
        // createExit(b, bobStart);   
        }
        //createExit(b, bobStart);
        // document.getElementById("score").setAttribute("style", "color:black;");
         //document.getElementById("score").setAttribute("style", "color:black;");        
        };
           // createExit(b, bobStart);
           
    };
    
};       //=========== end Game ================
//=======================================================================
let viewText = function(brd){   //show in existing div myText  
    
    let inner = "<h1>" + brd + "</h1>";    
    document.getElementById("myText").innerHTML = inner; 
    
};

window.onload = function(){     //called when the window has finished loading
    console.log("onload");
    let score = 0;
    let brd = new Game();       //random seeding
    brd.gameScore(score);
    
    
    document.onkeydown = function (ev) {  //keydown event  
     //if(gameWon == true){
       // alert("You have won! Total score: " + score);
    //}   
        console.log("down");
        console.log(score);
        let key = ev.keyCode;
        score = brd.move(key, score);
        brd.gameScore(score);
        viewText(brd);
        console.log(gameOver);
        if(gameWon == true){
        alert("You have won! Total score: " + score);
        gameOver = true;
        //throw '';
    }      
    };
    
    document.addEventListener('keydown', function(e) {
  if (e.keyCode == 88) {
    document.getElementById('audio').play();
  }
});
    
    viewText(brd);
    
};




