import axios from "axios"
const axiosRequest = axios.create({
    baseURL: "http://127.0.0.1:8000/api/",
    headers:{
        Authorization: `Bearer ${localStorage.getItem('AUTH_TOKEN')}`
    }
})
// axiosRequest.get('http://127.0.0.1:8000/sanctum/csrf-cookie').then((res)=>{
//     localStorage.setItem('AUTH_TOKEN', res.data)
// });
export default axiosRequest