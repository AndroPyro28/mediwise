window.addEventListener('load', async ()=> {
    try {
        const token = window.localStorage.getItem('token')

        const result = await fetch('http://localhost:3001/getMe', { // sending data to the server
            method: 'GET',
            headers: { token }
        }) // getting the data from server
        
        const data = await result.json()
        if(result.status !== 200) {
            window.localStorage.removeItem('token')
            return window.location.assign('login.html')
        }
    } catch (error) {
        window.localStorage.removeItem('token')
        return window.location.assign('login.html')
    }
   
})
