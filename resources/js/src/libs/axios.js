import Vue from 'vue'

// axios
import axios from 'axios'

const axiosIns = axios.create({
  // You can add your headers here
  // ================================
  baseURL: 'http://127.0.0.1:8000',
  timeout: 10800,
  headers: {
  	'X-Custom-Header': 'foobar',
  	'Accept': 'application/json',
  }
})

Vue.prototype.$http = axiosIns

export default axiosIns
