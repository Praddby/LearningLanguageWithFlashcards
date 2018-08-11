export default {

  // @path: pagination
  // @pageNo: pageNo
  nex(params) {
    return axios.get(params.path.next_page_url).then(response => response.data);
  },
  prev(params) {
    return axios.get(params.path.prev_page_url).then(response => response.data);
  },
  page(params) {
    return axios.get(params.path.path + '?page=' + params.pageNo).then(response => response.data);
  }
  
}
