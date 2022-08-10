window.onload = () => {
    refreshCart();
    refreshPrice();

}

function addToCart(pid, name, price) {
    name = decodeURIComponent(name.replace(/\+/g, ' '));
    // console.log(name);
    // add item into localstorage - shopping cart
    var cart = JSON.parse(localStorage.getItem("cart"));
    if (cart == null || !cart) {
        // console.log("cart is empty");
        var cart_items = [];
        var item = { 'pid': pid, 'name': name, 'price': price, 'quantity': 1, 'subtotal': price };
        cart_items.push(item);
        localStorage.setItem("cart", JSON.stringify(cart_items));
    } else {
        // console.log("cart is not empty");
        var stored = JSON.parse(localStorage.getItem("cart"));
        //check if the itme exists in the cart
        var exist = false;
        // check the items in the cart one by one
        for (var i = 0; i < stored.length; i++) {
            // the item exists in the cart
            if (stored[i] != null) {

                if (stored[i].pid == pid) {
                    stored[i].quantity += 1;
                    stored[i].price = price;
                    stored[i].subtotal += price;
                    localStorage.setItem("cart", JSON.stringify(stored));
                    exist = true;
                }
            }
        }

        // the item is not exist in the cart
        if (exist == false) {
            var item = { 'pid': pid, 'name': name, 'price': price, 'quantity': 1, 'subtotal': price };
            stored.push(item);
            localStorage.setItem("cart", JSON.stringify(stored));
        }

    }
    var result = JSON.parse(localStorage.getItem("cart"));
    console.log(result);

    let list = document.querySelector("table tbody")
    list.innerHTML = ''
    for (var i = 0; i < result.length; i++) {
        if (result[i] != null) {
            list.innerHTML += `
         
            <td>${result[i].name}</td>
                <td><input type="number" class="form-control" id="quantity" name="quantity" 
                value="${result[i].quantity}" min="0" 
                onChange="updateQuantity(this.value, ${result[i].pid})"></td>
            <td id="subtotal">$${result[i].subtotal}</td>
            `;
        }
    }


    refreshPrice();

}

function refreshCart() {
    var stored_cart = JSON.parse(localStorage.getItem("cart"));

    if (stored_cart != null) {
        let list = document.querySelector("table tbody")
        list.innerHTML = ''
        for (var i = 0; i < stored_cart.length; i++) {
            if (stored_cart[i] != null) {
                list.innerHTML += `
                <td>${stored_cart[i].name}</td>
                    <td><input type="number" class="form-control" id="quantity" name="quantity" 
                    value="${stored_cart[i].quantity}" min="0" 
                    onChange="updateQuantity(this.value, ${stored_cart[i].pid})"></td>
                <td id="subtotal">$${stored_cart[i].subtotal}</td>
                `
            }

        }
    }
}

function refreshPrice() {
    let amount = document.querySelectorAll(".amount");

    for (var j = 0; j < amount.length; j++) {
        amount[j].innerHTML = calAmount();
    }
}

function calAmount() {
    var stored_cart = JSON.parse(localStorage.getItem("cart"));
    var amount = 0;
    if (stored_cart != null) {
        for (var i = 0; i < stored_cart.length; i++) {
            if (stored_cart[i] != null) {
                amount += stored_cart[i].subtotal;
            } else {
                amount += 0;
            }
        }
    }
    // console.log("Total amount: "+amount);
    return amount;
}

function updateQuantity(value, pid) {
    // console.log(`update pid ${pid} quantity`)
    // update local storage
    let stored = JSON.parse(window.localStorage.getItem('cart'))

    for (var i = 0; i < stored.length; i++) {
        if (stored[i] != null) {
            var div = "row-" + stored[i].pid;
            if (stored[i].pid == pid) {
                if (value == 0) {
                    delete stored[i]
                    var subtotal = document.getElementById("subtotal");
                    subtotal.closest("tr").remove();
                } else {
                    stored[i].quantity = parseInt(value);
                    stored[i].subtotal = value * stored[i].price;
                    var subtotal = document.getElementById("subtotal");
                    subtotal.innerHTML = "$" + stored[i].subtotal;
                }
                localStorage.setItem("cart", JSON.stringify(stored));
            }
        }

    }
    console.log(JSON.parse(localStorage.getItem("cart")));
    refreshPrice();
}

function clearCart() {
    let list = document.querySelector("table tbody");
    list.innerHTML = '';
    let amount = document.querySelectorAll(".amount");
    for (var j = 0; j < amount.length; j++) {
        amount[j].innerHTML = '';
    }
    localStorage.setItem("cart", null);
}

paypal.Buttons({
    // Sets up the transaction when a payment button is clicked
    createOrder: (data, actions) => {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: calAmount()
                }
            }]
        });
    },
    // Finalize the transaction after payer approval
    onApprove: (data, actions) => {
        return actions.order.capture().then(function (orderData) {
            // Successful capture! For dev/demo purposes:
            // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            const transaction = orderData.purchase_units[0].payments.captures[0];
            clearCart();
            callPHP(transaction.id, transaction.status);
            alert("Thank you for shopping!");

            // alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);

            // When ready to go live, remove the alert and show a success message within this page. For example:
            // const element = document.getElementById('paypal-button-container');
            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
            // Or go to another URL:  actions.redirect('thank_you.html');
        });
    }
}).render('#paypal-button-container');

