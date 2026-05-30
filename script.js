// تشغيل دالة تحديث العداد التلقائي بمجرد دخول الزبون لصفحة المنيو
document.addEventListener('DOMContentLoaded', updateCartBadge);

// دالة إضافة المشروب وحفظه مؤقتاً في ذاكرة المتصفح للذهاب لصفحة السلة لاحقاً
function addToCart(productId, productName, productPrice) {
    let cart = JSON.parse(localStorage.getItem('ararat_cart')) || [];

    // التحقق إذا كان المشروب مضاف مسبقاً لزيادة كميته فقط
    const existingItem = cart.find(item => item.name === productName);
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({ id: productId, name: productName, price: productPrice, quantity: 1 });
    }

    // حفظ التعديلات الجديدة في الذاكرة
    localStorage.setItem('ararat_cart', JSON.stringify(cart));

    // تحديث العداد الرقمي الأحمر فوق أيقونة الهيدر فوراً
    updateCartBadge();

    // رسالة تنبيه ناعمة للزبون تفيد بنجاح الإضافة
    alert(productName + " has been added to your cart!");
}

// دالة لحساب وعرض عدد العناصر في الدائرة الحمراء (تطابق صورة image_4.png)
function updateCartBadge() {
    const cart = JSON.parse(localStorage.getItem('ararat_cart')) || [];
    const countBadge = document.getElementById('cart-count');
    
    if (countBadge) {
        let totalCount = 0;
        cart.forEach(item => {
            totalCount += item.quantity;
        });
        
        // إدخال المجموع في العداد
        countBadge.innerText = totalCount;
    }
}

// دالة يتم استدعاؤها عند الضغط على أيقونة السلة في الهيدر للتوجه لصفحة المشتريات
function navigateToCart() {
    window.location.href = 'cart.html';
}