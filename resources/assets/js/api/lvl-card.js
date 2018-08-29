export default {

  setCardLvl(params){
    let data = {
      lvl: params.lvl
    };

    return axios.put(`lvl_card/${params.id}`, data);
  },

  getCardsLvl(lvl){
    return axios.get(`lvl_card/${lvl}`).then(response => response.data);
  }

}
