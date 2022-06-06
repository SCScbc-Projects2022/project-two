document.querySelector('#greeting').textContent = `Welcome back, ${localStorage.getItem('username')}!`;

document.querySelector('#logout-btn').addEventListener('click', async () => {
    const logout = await fetch('/api/users/logout', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'}
    });
    if (logout.ok) {
        localStorage.clear();
        document.location.replace('/home');
    } else {
        alert(response.statusText);
    }
})