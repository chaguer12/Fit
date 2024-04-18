import axios from "axios";

const Http = axios.create({
    baseURL: 'http://localhost:8000/api'
})

export default Http