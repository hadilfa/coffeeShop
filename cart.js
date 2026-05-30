// تشغيل الدالة فوراً بمجرد فتح صفحة السلة لقراءة البيانات المحفوظة
document.addEventListener('DOMContentLoaded', displayCart);

function displayCart() {
    // جلب المنتجات المخزنة من ذاكرة المتصفح المحلية
    const cart = JSON.parse(localStorage.getItem('ararat_cart')) || [];
    
    const tableWrapper = document.getElementById('cart-table-wrapper');
    const emptyMsg = document.getElementById('empty-cart-msg');
    const rowsContainer = document.getElementById('cart-rows');
    const finalTotalDisplay = document.getElementById('final-total');
    const summaryBox = document.getElementById('cart-summary-box');

    // التحقق إذا كانت السلة فارغة تماماً
    if (cart.length === 0) {
        tableWrapper.style.display = 'none';
        summaryBox.style.display = 'none';
        emptyMsg.style.display = 'block';
        return;
    }

    // إظهار الجدول وإخفاء رسالة الفراغ
    tableWrapper.style.display = 'block';
    summaryBox.style.display = 'flex';
    emptyMsg.style.display = 'none';
    
    rowsContainer.innerHTML = ''; // تنظيف الأسطر السابقة
    let totalAmount = 0;

    // بناء الهيكل الجدولي للمشتريات سطر بسطر تلقائياً
    cart.forEach((item, index) => {
        const subtotal = item.price * item.quantity;
        totalAmount += subtotal;

        rowsContainer.innerHTML += `
            <tr>
                <td><strong>${item.name}</strong></td>
                <td>${item.price} DA</td>
                <td>${item.quantity}</td>
                <td style="color: var(--accent-gold-muted); font-weight: bold;">${subtotal} DA</td>
                <td><button class="btn-delete" onclick="removeItem(${index})">🗑️ Delete</button></td>
            </tr>
        `;
    });

    // تحديث السعر الإجمالي الكلي النهائي في الأسفل
    finalTotalDisplay.innerText = totalAmount + ' DA';
}

// دالة مخصصة لحذف مشروب معين من السلة عند الضغط على زر الحذف
function removeItem(index) {
    let cart = JSON.parse(localStorage.getItem('ararat_cart')) || [];
    cart.splice(index, 1); // مسح العنصر المحدد من المصفوفة
    localStorage.setItem('ararat_cart', JSON.stringify(cart)); // إعادة حفظ السلة المحدثة بالذاكرة
    displayCart(); // تحديث الجدول على الشاشة فوراً
}

// دالة زر التوجيه المؤدية إلى صفحة ملء البيانات الشخصية (الخطوة القادمة)
function goToCheckout() {
    window.location.href = 'checkout.html';
}