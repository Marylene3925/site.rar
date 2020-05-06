function surligneTableaux___OLD(couleur1, couleur2)
{
	var tables = document.getElementsByTagName("table");
	var len = tables.length;

	for (var i = 0; i < len; i++)
	{
		surligne1tableau(tables[i], couleur1, couleur2);
	}
}



function surligneTableaux(couleur1, couleur2)
{
	var monTableau = document.getElementById("tableauFormulaire");
	
	if (monTableau == null) {
		return false;
	}
	
	surligne1tableau(monTableau, couleur1, couleur2);
	
}



function surligne1tableau(elm, couleur1, couleur2)
{
	var blen = elm.tBodies.length;
	
	for (var k = 0; k < blen; k++)
	{
		var n = elm.tBodies[k].rows.length;

		for (var i = 0; i < n; i++)
		{
			var len = elm.tBodies[k].rows[i].cells.length;
			
			for (var j = 0; j < len; j++)
			{
				elm.tBodies[k].rows[i].cells[j].style.backgroundColor = i % 2 ? couleur1 : couleur2;
			}   
		}
	}	
}




function surligne1tableau2x4(couleur1, couleur2)
{	
	var elm = document.getElementById("tableauFormulaire2");
	
	if (elm == null) {
		return false;
	}
	
	var blen = elm.tBodies.length;
	
	for (var k = 0; k < blen; k++)
	{
		var n = elm.tBodies[k].rows.length;

		for (var i = 0; i < n; i++)
		{
			var len = elm.tBodies[k].rows[i].cells.length;
			
			for (var j = 0; j < len; j++)
			{
				
				elm.tBodies[k].rows[i].cells[j].style.backgroundColor = (i<=1 || i==4 || i==5 || i==8 || i==9 || i==12 || i==13 || i==16 || i==17 || i==20 || i==21 || i==24 || i==25 || i==28 || i==29 || i==32 || i==33)  ? couleur1 : couleur2;
				
				
			}   
		}
	}	
}

//window.onload = foo;