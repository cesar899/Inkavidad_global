import state from './state';
// import * as actions from './actions';
import getters from './getters';
import * as mutations from './mutations';

export default {
  namespaced: true,
  getters,
  mutations,
//   actions,
  state
}
