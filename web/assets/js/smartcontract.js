function createContract(){
    let contract = new web3.eth.Contract(abi);
    return contract; 
}

function openContract(address){
    let contract = new web3.eth.Contract(abi, address);
    return contract; 
}

function delegate (contract, address) {
	let addr_to = '0xf6f45356002Eee48a0333c480da441dAdFcE1373';
	let token_id = 3;
	console.log("HUILOOOOO");
    console.log(contract);
    console.log(web3.eth.accounts[0]);
	if (web3.eth.accounts[0]) {
    console.log(web3.eth.accounts[0]);
    } else {
        console.log("HUILOOOOO111");
        //setTimeout(loop, 100);
    }
    jQuery.ajax({
	  type: "POST",
	  url: "delegate.php",
	  data: {contract_address : address, owner_address : addr_to},
	  success: function(responce) {
	  alert("Билет делегирован!")
	}
	});
	contract.delegateToken(addr_to, token_id, { from: window.web3.eth.accounts[0] }, function (e,r) { 
	 console.log(r);
    })
}

