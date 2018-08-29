export default {

  setLastRepeat(lvl){
    return axios.post('/lvl_notification', {lvl});
  }

}
