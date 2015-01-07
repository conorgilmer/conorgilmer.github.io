program three;

var 
winning, chosen, remove:integer;
stick, twist, games, num:cardinal;
stickR, twistR, gamesR:real;
stickpc, twistpc:real;
letter:char;

(* return a random card a number between 1 and 3 *)
function randomcard(cards:integer) : integer;
var
rvar:integer;
begin
	randomize;
	rvar := random(cards) + 1;	
(*	writeln('random = ', rvar);*)
	randomcard := rvar;
end;

(* play a game of selecting from three cards *)
procedure play;
begin
	writeln('in play ', num);

	winning := randomcard(3);
	chosen := randomcard(3);
	
	repeat
  	remove := randomcard(3);
	until (remove <> winning) and (remove <> chosen);

	writeln('winning = ', winning, ' | chosen = ', chosen, ' | remove = ', remove );

	if winning = chosen then
	begin
		stick := stick + 1;
	end
	else
		twist := twist + 1;
end;

(* Main Program Three Card Paradox *)
begin

	games := 100;

	writeln('Three Card Paradox');
	for num :=1 to games do
		play;
	writeln('Results:');
	stickR := stick;
	twistR := twist;
	gamesR := games;
	stickpc := (stickR/gamesR) *100.0;
	twistpc := (twistR/gamesR) *100.0;
	writeln('Game played ', games, ' times');
	writeln('Sticking wins ', stick, ' times (', stickpc:2:2, '%)');
	writeln('Changing wins ', twist, ' times (', twistpc:2:2, '%)');
	writeln('Verdict:');
	if stick < twist then
	begin
		writeln('Twisting wins more!');
	end
	else
		writeln('Sticking wins more!');
	writeLn('The End.');
end.
