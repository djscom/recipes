inputs = function(){
	function addInput(e){
		e.preventDefault();
		var form = e.target.parentElement;
		
    var brk = document.createElement("br");
    form.insertBefore(brk, e.target);
    
    var i = document.createElement("input");
		i.setAttribute("type", "text");
		i.setAttribute("name", form.children[1].getAttribute("name"));
		i.setAttribute("placeholder", e.target.parentElement.children[1].getAttribute("placeholder"));
    var insin = form.insertBefore(i, e.target);
		
		var b = document.createElement("button");	
		var t = document.createTextNode("-");	
		b.onclick = function(){
      b.previousElementSibling.remove();
      b.previousElementSibling.remove();
      b.remove();
    };	
		b.appendChild(t);	
		insin.insertAdjacentElement('afterend', b)
	}
	function removeInput(e){
		e.preventDefault();
		var form = e.target.parentElement;
		e.target.previousElementSibling.remove();
		e.target.remove();
	}
  return{
		addInput:addInput,
		removeInput:removeInput
  }
}();