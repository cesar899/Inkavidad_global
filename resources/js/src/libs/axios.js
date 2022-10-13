import Vue from 'vue'
import store from '@/store'
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
    'Authorization' : `Bearer ${localStorage.getItem('jwt') != null ? localStorage.getItem('jwt') : ''}`,
  }
})

Vue.prototype.$http = axiosIns

export default axiosIns
