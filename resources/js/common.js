window.common = {

    isActionName(actionName) {
        let url = new URL(window.location.href);
        let pathParts = url.pathname.split('/').filter(part => part !== '');
        let action = pathParts[pathParts.length - 1];
        return action === actionName;
    }

};
