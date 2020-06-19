import { HTTP } from './baseService';

class ToolService {

    getTools(searchTerm){
        return HTTP.get('/tools', {params: {searchTerm: searchTerm}});
    }

    createTool(tool){
        return HTTP.post('/tools', tool);
    }

    
}

const toolService = new ToolService();
export default toolService;