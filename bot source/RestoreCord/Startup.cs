using RestoreCord.Services;
using Discord;
using Discord.WebSocket;
using Microsoft.EntityFrameworkCore;
using Microsoft.Extensions.Configuration;
using Microsoft.Extensions.DependencyInjection;
using System;
using System.Threading.Tasks;
using System.Threading;

namespace RestoreCord
{
    class Startup
    {
        public IConfigurationRoot Configuration { get; }
        private readonly DiscordShardedClient _client;
        internal static async Task Main() => await new Startup().RunAsync();
        private Startup()
        {
            _client = new DiscordShardedClient(new DiscordSocketConfig
            {
                LogLevel = LogSeverity.Verbose,
                AlwaysDownloadUsers = true,
                GatewayIntents = GatewayIntents.AllUnprivileged,
                UseSystemClock = false,
            });
            // Check if environment variables are set
            if (!AppEnvironment.Check()){
                Console.WriteLine("Environment variables are not set!");
                Console.WriteLine("Press any key to exit...");
                Console.ReadKey();
                Environment.Exit(1);
            }
        }

        private async Task RunAsync()
        {
            var services = new ServiceCollection();
            ConfigureServices(services);
            var provider = services.BuildServiceProvider();
            provider.GetRequiredService<Database>().Database.Migrate();
            provider.GetRequiredService<Log>();
            provider.GetRequiredService<Custom>();
            provider.GetRequiredService<Command>();
            provider.GetRequiredService<Message>();
            await _client.LoginAsync(TokenType.Bot, AppEnvironment.BOT_TOKEN);
            await _client.StartAsync();
            await Task.Delay(Timeout.Infinite);
        }

        private void ConfigureServices(IServiceCollection services)
        {
            services.AddDbContext<Database>()
            .AddSingleton(_client)
            .AddSingleton<Command>()
            .AddSingleton<Custom>()
            .AddSingleton<Log>()
            .AddSingleton(new Random())
            .AddSingleton<Message>();
        }
    }
}
