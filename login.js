const users = [
  { username: "admin", password: "123", role: "admin" },
  { username: "kitchen", password: "123", role: "kitchen" }
];

function login() {
  let u = document.getElementById("username").value;
  let p = document.getElementById("password").value;

  let user = users.find(x => x.username === u && x.password === p);

  if (!user) {
    alert("Wrong credentials");
    return;
  }

  // حفظ الدور في الذاكرة المحلية لاستخدامه في الصفحات الأخرى
  localStorage.setItem("role", user.role);

  if (user.role === "admin") {
    window.location.href = "admin.html";
  } else {
    // التوجيه إلى ملف الـ PHP المحمي الذي صممناه
    window.location.href = "kitchen.php";
  }
}