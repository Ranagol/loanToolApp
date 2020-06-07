import { HTTP } from './baseService';

class ToolService {

    getTools(searchTerm){
        return HTTP.get('/tools', {params: {searchTerm: searchTerm}});
    }

    
}

const toolService = new ToolService();
export default toolService;