/*
*       Script: Mascaras em Javascript
*       Autor:  Matheus Biagini de Lima Dias
*       Data:   26/08/2008
*       Obs:    
*/




/*
<table width="100%" border="0">
	<tr>
			<td colspan="2" align="center"><strong>Exemplos de Funções de mascaras em javascript</strong></td>
	</tr>
	<tr bgcolor="#e1e1e1">
			<td width="13%">[Só numeros]</td>
			<td width="87%"><input name="int" type="text" id="int" onkeydown="Mascara(this,Integer);" onkeypress="Mascara(this,Integer);" onkeyup="Mascara(this,Integer);"></td>
	</tr>
	<tr>
			<td width="13%">[Telefone]</td>
			<td width="87%"><input name="tel" type="text" id="tel" maxlength="14" onkeydown="Mascara(this,Telefone);" onkeypress="Mascara(this,Telefone);" onkeyup="Mascara(this,Telefone);"></td>
	</tr>
	<tr bgcolor="#e1e1e1">
			<td width="13%">[CPF]</td>
			<td width="87%"><input name="cpf" type="text" id="cpf" maxlength="14" onkeydown="Mascara(this,Cpf);" onkeypress="Mascara(this,Cpf);" onkeyup="Mascara(this,Cpf);"></td>
	</tr>
	<tr>
			<td width="13%">[Cep]</td>
			<td width="87%"><input name="cep" type="text" id="cep" maxlength="9" onkeydown="Mascara(this,Cep);" onkeypress="Mascara(this,Cep);" onkeyup="Mascara(this,Cep);"></td>
	</tr>
	<tr bgcolor="#e1e1e1">
			<td width="13%">[CNPJ]</td>
			<td width="87%"><input name="cnpj" type="text" id="cnpj" maxlength="18" onkeydown="Mascara(this,Cnpj);" onkeypress="Mascara(this,Cnpj);" onkeyup="Mascara(this,Cnpj);"></td>
	</tr>
	<tr>
			<td width="13%">[Romanos]</td>
			<td width="87%"><input name="rom" type="text" id="rom"  onkeydown="Mascara(this,Romanos);" onkeypress="Mascara(this,Romanos);" onkeyup="Mascara(this,Romanos);"></td>
	</tr>
	<tr bgcolor="#e1e1e1">
			<td width="13%">[Site]</td>
			<td width="87%"><input name="sit" type="text" id="sit"  onkeydown="Mascara(this,Site);" onkeypress="Mascara(this,Site);" onkeyup="Mascara(this,Site);"></td>
	</tr>
	<tr>
			<td width="13%">[Data]</td>
			<td width="87%"><input name="date" type="text" id="date" maxlength="10" onkeydown="Mascara(this,Data);" onkeypress="Mascara(this,Data);" onkeyup="Mascara(this,Data);"></td>
	</tr>
	<tr bgcolor="#e1e1e1">
			<td width="13%">[Area Valor]</td>
			<td width="87%"><input name="arevalo" type="text" id="arevalo"  onkeydown="Mascara(this,Area);" onkeypress="Mascara(this,Area);" onkeyup="Mascara(this,Area);"></td>
	</tr>

*/



        /*Função Pai de Mascaras*/
        function Mascara(o,f){
                v_obj=o
                v_fun=f
                setTimeout("execmascara()",1)
        }
        
        /*Função que Executa os objetos*/
        function execmascara(){
                v_obj.value=v_fun(v_obj.value)
        }
        
        /*Função que Determina as expressões regulares dos objetos*/
        function leech(v){
                v=v.replace(/o/gi,"0")
                v=v.replace(/i/gi,"1")
                v=v.replace(/z/gi,"2")
                v=v.replace(/e/gi,"3")
                v=v.replace(/a/gi,"4")
                v=v.replace(/s/gi,"5")
                v=v.replace(/t/gi,"7")
                return v
        }
        
        /*Função que permite apenas numeros*/
        function Integer(v){
                return v.replace(/\D/g,"")
        }
        
        /*Função que padroniza telefone (11) 4184-1241*/
        function Telefone(v){
                v=v.replace(/\D/g,"")                            
                v=v.replace(/^(\d\d)(\d)/g,"($1) $2") 
                v=v.replace(/(\d{4})(\d)/,"$1-$2")      
                return v
        }
        
        /*Função que padroniza telefone (11) 41841241*/
        function TelefoneCall(v){
                v=v.replace(/\D/g,"")                            
                v=v.replace(/^(\d\d)(\d)/g,"($1) $2")   
                return v
        }
        
        /*Função que padroniza CPF*/
        function Cpf(v){
                v=v.replace(/\D/g,"")                                   
                v=v.replace(/(\d{3})(\d)/,"$1.$2")         
                v=v.replace(/(\d{3})(\d)/,"$1.$2")         
                                                                                                 
                v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
 
                return v
        }
        
        /*Função que padroniza CEP*/
        function Cep(v){
                v=v.replace(/D/g,"")                            
                v=v.replace(/^(\d{5})(\d)/,"$1-$2") 
                return v
        }
        
        /*Função que padroniza CNPJ*/
        function Cnpj(v){
                v=v.replace(/\D/g,"")                              
                v=v.replace(/^(\d{2})(\d)/,"$1.$2")      
                v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3") 
                v=v.replace(/\.(\d{3})(\d)/,".$1/$2")              
                v=v.replace(/(\d{4})(\d)/,"$1-$2")                        
                return v
        }
        
        /*Função que permite apenas numeros Romanos*/
        function Romanos(v){
                v=v.toUpperCase()                        
                v=v.replace(/[^IVXLCDM]/g,"") 
                
                while(v.replace(/^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/,"")!="")
                        v=v.replace(/.$/,"")
                return v
        }
        
        /*Função que padroniza o Site*/
        function Site(v){
                v=v.replace(/^http:\/\/?/,"")
                dominio=v
                caminho=""
                if(v.indexOf("/")>-1)
                        dominio=v.split("/")[0]
                        caminho=v.replace(/[^\/]*/,"")
                        dominio=dominio.replace(/[^\w\.\+-:@]/g,"")
                        caminho=caminho.replace(/[^\w\d\+-@:\?&=%\(\)\.]/g,"")
                        caminho=caminho.replace(/([\?&])=/,"$1")
                if(caminho!="")dominio=dominio.replace(/\.+$/,"")
                        v="http://"+dominio+caminho
                return v
        }

        /*Função que padroniza DATA*/
        function Data(v){
                v=v.replace(/\D/g,"") 
                v=v.replace(/(\d{2})(\d)/,"$1/$2") 
                v=v.replace(/(\d{2})(\d)/,"$1/$2") 
                return v
        }
        
        /*Função que padroniza DATA*/
        function Hora(v){
                v=v.replace(/\D/g,"") 
                v=v.replace(/(\d{2})(\d)/,"$1:$2")  
                return v
        }
        
        /*Função que padroniza valor monétario*/
        function Valor(v){
                v=v.replace(/\D/g,"") //Remove tudo o que não é dígito
                v=v.replace(/^([0-9]{3}\.?){3}-[0-9]{2}$/,"$1.$2");
                //v=v.replace(/(\d{3})(\d)/g,"$1,$2")
                v=v.replace(/(\d)(\d{2})$/,"$1.$2") //Coloca ponto antes dos 2 últimos digitos
                return v
        }
        
        /*Função que padroniza Area*/
        function Area(v){
                v=v.replace(/\D/g,"") 
                v=v.replace(/(\d)(\d{2})$/,"$1.$2") 
                return v
                
        }