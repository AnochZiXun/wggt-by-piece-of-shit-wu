/**
 * @author P-C Lin (a.k.a 高科技黑手)
 */
var web3 = new Web3(Web3.givenProvider || "https://mainnet.infura.io/v3/e55945834108462d8637fd03b9d35ffc");
var jsonInterface = [{"constant":true,"inputs":[],"name":"name","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"tokens","type":"uint256"}],"name":"approve","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"from","type":"address"},{"name":"to","type":"address"},{"name":"tokens","type":"uint256"}],"name":"transferFrom","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"tokenOwner","type":"address"}],"name":"balanceOf","outputs":[{"name":"balance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"acceptOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"to","type":"address"},{"name":"tokens","type":"uint256"}],"name":"transfer","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"tokens","type":"uint256"},{"name":"data","type":"bytes"}],"name":"approveAndCall","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"newOwner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"tokenAddress","type":"address"},{"name":"tokens","type":"uint256"}],"name":"transferAnyERC20Token","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"tokenOwner","type":"address"},{"name":"spender","type":"address"}],"name":"allowance","outputs":[{"name":"remaining","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"payable":true,"stateMutability":"payable","type":"fallback"},{"anonymous":false,"inputs":[{"indexed":true,"name":"_from","type":"address"},{"indexed":true,"name":"_to","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"tokens","type":"uint256"}],"name":"Transfer","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"tokenOwner","type":"address"},{"indexed":true,"name":"spender","type":"address"},{"indexed":false,"name":"tokens","type":"uint256"}],"name":"Approval","type":"event"}];
var contractAddress = '0xD49139CA5832C20c513ECa082Da349E7CdFCf0D5';
var ownerAddress = '0xC76691049EBfa8409e2CE1DC23DAD9b4f3C06c16';

$(document).ready(function () {
	$('[data-toggle="tooltip"]').tooltip();

	console.log(web3.currentProvider);

	$('BUTTON.fa-copy').click(function () {
		var that = $(this).parents('DIV.input-group').children('INPUT[type="text"]');
		$(that).select();
		document.execCommand('copy');
		that.blur();
	});

	$('FORM#web3EthAccountsCreate1').submit(function (e) {
		e.preventDefault();

		var account = web3.eth.accounts.create();
		$('#web3EthAccountsCreate1Address').val(account.address);
		$('#web3EthAccountsCreate1PrivateKey').val(account.privateKey);

		return false;
	});

	$('FORM#web3EthAccountsCreate2').submit(function (e) {
		e.preventDefault();

		var account = web3.eth.accounts.create(web3.utils.randomHex(32));
		$('#web3EthAccountsCreate2Address').val(account.address);
		$('#web3EthAccountsCreate2PrivateKey').val(account.privateKey);

		return false;
	});

	$('FORM#web3EthAccountsCreate3').submit(function (e) {
		e.preventDefault();

		var account = web3.eth.accounts.privateKeyToAccount($('#web3EthAccountsCreate3PrivateKey').val());
		$('#web3EthAccountsCreate3Address').val(account.address);

		return false;
	});

	$('FORM#web3EthGetBalance').submit(function (e) {
		e.preventDefault();
		var accountAddress = $('#web3EthGetBalanceAddress').val();

		web3.eth.getBalance(accountAddress, function (error, result) {
			$('#web3EthGetBalanceEther').val(result / Math.pow(10, 18));
		});

		var contract = new web3.eth.Contract(jsonInterface, contractAddress, {
			from: accountAddress,
			gasPrice: 5000000000
		});

		contract.methods.balanceOf(contractAddress).call({from: accountAddress}, function (error, result) {
			$('#web3EthGetBalanceWindGreenGainCoin').val(result / Math.pow(10, 18));
		});
	
		return false;
	});

	$('FORM#web3EthSendSignedTransaction').submit(function (e) {
		e.preventDefault();
		var accountAddress = $('#web3EthSendSignedTransactionAddress').val(), web3EthSendSignedTransactionPrivateKey = $('#web3EthSendSignedTransactionPrivateKey').val(), web3EthSendSignedTransactionWithdrawAmount = $('#web3EthSendSignedTransactionWithdrawAmount').val();

		web3.eth.getTransactionCount(accountAddress, web3.eth.defaultBlock.pending).then(function(nonce) {
			var txWithdrawData = {
				chainId: 1,
				gasLimit: web3.utils.toHex(99000),
				gasPrice: web3.utils.toHex(10e9),
				from: accountAddress,
//				to: contractAddress,
				to: '0xC3d9C17d7F6988C0fe7eBe929C47eFCCBd92bE13',//小武的錢包地址
				nonce: web3.utils.toHex(nonce++),
				data: '',
				value: web3.utils.toHex(web3EthSendSignedTransactionWithdrawAmount * Math.pow(10, 18))//以太幣金額(單位：wei)轉16進位
			};

			var txWithdraw = new Tx(txWithdrawData);
			console.log(txWithdraw);
			var privateKey = new Buffer(web3EthGetBalancePrivateKey, 'hex');
			txWithdraw.sign(privateKey);
			var serializedTx = txWithdraw.serialize().toString('hex');
			web3.eth.sendSignedTransaction('0x' + serializedTx.toString('hex'), function(error, result) {
				if (!error) {
					console.log(result);
				} else {
					console.error(error);
				}
			});
		});

		return false;
	});
});