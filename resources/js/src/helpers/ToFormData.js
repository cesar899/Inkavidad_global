export default class {

    static transform(json) {
      let data = new FormData();

      for (var key in json) {
        if (typeof json[key] == 'object') {
          if( json[key] instanceof File )  data.append( key, json[key]);
          else data.append(key, JSON.stringify(json[key]));
        }else if(json[key] === true){
          data.append(key, 1);
        }else if(json[key] === false){
          data.append(key, 0);
        }else{
          data.append(key, json[key]);
        }
      }

      return data;
    }
}
