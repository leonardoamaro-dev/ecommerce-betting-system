// CREDISTS LEONARDO AMARO

var target_time = [];
var string_time;
var loop;
var i = 0;
var count_length = length;
try {
    var length = document.getElementById('lenght').value * 3;
}
catch (e) {
}

function selectCronometro() {
	i++;
	if (i > length) {
	    i = 0;
    }
}

function startCounting() {
	try {
        var difference = [];
		var icount;
		
		// PEGANDO O TEMPO DE CADA CRONOMETO
		for (icount = 0; icount < length; icount++) {
		    difference.push(document.getElementsByClassName('cronometro-button')[icount].innerText);
		}
		
		// VARIAVEIS RESPONSÁVEIS POR SEPARAR OS MINUTOS E SEGUNDOS DOS CRONOMETOS
		var values,
	    minutes,
		seconds;
		
		// EM UM LOOP CHAMA A FUNÇÃO QUE FAZ OS UPDATE DOS CRONOMETOS 
        if (loop) window.clearInterval(loop);
	    loop = window.setInterval("update()", 1);
	    loop1 = window.setInterval("selectCronometro()", 1); 
		
		// PEGAR OS MINUTOS E SEGUNDOS E SEPARAR EM CADA VARIAVEL
		for (icount = 0; icount < length; icount++) {
		    values = difference[icount].split(':');
	        minutes = parseInt(values[0]);
	        seconds = parseInt(values[1]);
			target_time[icount] = new Date(Date.now() + seconds*1000 + minutes*1000*60);
		}
		
        // SE NÃO RECEBEU OS MUNUTOS E SEGUNDOS ELE ACABA NÃO REALIZA A CONTAGEM		
	    if (!minutes && !seconds) {
	    	return false;
	    }
    }
    catch (e) {
    }
}


function update() {
	// RECEBE TEMPO DE CADA CRONOMETO
	var time = format_seconds(getTime());
	// RECEBE NOVA QUANTIDADE DE CRONOMETOS ATIVOS
	count_length = document.getElementById('lenght').value * 3;
	
	// CASO O TEMPO DO CRONOMETO ACABE LIBERA O BOTÃO
	if (getTime() <= 0) {
		try {
	    document.getElementsByClassName('cronometro-button')[i].style.cursor = "pointer";
	    document.getElementsByClassName('cronometro-button')[i].innerText = "COMPRAR !";
	    document.getElementsByClassName('cronometro-button')[i].style.backgroundColor = "#1cdc57";
	    document.getElementsByClassName('cronometro-button')[i].disabled = false;
		}
		catch (e) {
   		}
		// CASO ACABE O TEMPO DE TODOS OS CRONOMETO INTERROMPE O LOOPING
		if (count_length <= 0) {
		finish();
		return;
		}
	}
	else {
	    try {
			// ATUALIZAÇÃO CONSTANTE DOS TEMPOS DO CRONOMETOS
	        document.getElementsByClassName('cronometro-button')[i].style.cursor = "not-allowed";
            document.getElementsByClassName('cronometro-button')[i].disabled = true;
		    document.getElementsByClassName('cronometro-button')[i].innerText = time;
        }
	    catch (e) {
        }
	}
}


function finish() {
    stop();
}


function getTime() {
	return (target_time[i] - new Date());
}


function format_seconds(seconds) {
	if(isNaN(seconds))
		seconds = 0;

	var diff = new Date(seconds);
	var minutes = diff.getMinutes();
	var seconds = diff.getSeconds();
	var milliseconds = diff.getMilliseconds();

	if (minutes < 10)
		minutes = "0" + minutes;
	if (seconds < 10)
		seconds = "0" + seconds;

	if (milliseconds < 10)
		milliseconds = "00" + milliseconds;
	else if (milliseconds < 100)
		milliseconds = "0" + milliseconds;

	return minutes + ":" + seconds + ":" + milliseconds;
}


function stop() {
	clearInterval(loop);
	clearInterval(loop1);
	loop = null;
	loop1 = null

	target_time[i] = null;
}


