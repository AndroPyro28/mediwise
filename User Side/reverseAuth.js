window.addEventListener('load', async ()=> {
    const token = window.localStorage.getItem('token')

    const result = await fetch('http://localhost:3001/getMe', { // sending data to the server
        method: 'GET',
        headers: { token }
    }) // getting the data from server

    const data = await result.json()
    if(result.status === 200 && data.success) {
        return window.location.assign('home.html')
    }
})