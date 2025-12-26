import { motion } from "framer-motion";
import MainLayout from "@/layouts/MainLayout";
import SectionHeading from "@/components/atoms/SectionHeading";
import { aboutContent } from "@/data/content";

const About = () => {
  return (
    <MainLayout>
      <section className="py-24 bg-background">
        <div className="container mx-auto px-6">
          <div className="max-w-4xl mx-auto">
            <SectionHeading
              title={aboutContent.heading}
              subtitle={aboutContent.subheading}
            />

            <div className="grid grid-cols-1 lg:grid-cols-5 gap-12 items-start">
              {/* Text Content */}
              <div className="lg:col-span-3 space-y-6">
                {aboutContent.paragraphs.map((paragraph, index) => (
                  <motion.p
                    key={index}
                    className="text-muted-foreground leading-relaxed text-lg"
                    initial={{ opacity: 0, y: 20 }}
                    whileInView={{ opacity: 1, y: 0 }}
                    viewport={{ once: true }}
                    transition={{ delay: index * 0.1 }}
                  >
                    {paragraph}
                  </motion.p>
                ))}

                <motion.div
                  className="p-6 rounded-2xl bg-card border border-border"
                  initial={{ opacity: 0, y: 20 }}
                  whileInView={{ opacity: 1, y: 0 }}
                  viewport={{ once: true }}
                  transition={{ delay: 0.3 }}
                >
                  <span className="text-sm text-primary font-medium">Current Focus</span>
                  <p className="mt-2 text-foreground">
                    {aboutContent.currentFocus}
                  </p>
                </motion.div>
              </div>

              {/* Stats */}
              <div className="lg:col-span-2">
                <motion.div
                  className="p-8 rounded-2xl bg-card border border-border space-y-8"
                  initial={{ opacity: 0, x: 20 }}
                  whileInView={{ opacity: 1, x: 0 }}
                  viewport={{ once: true }}
                >
                  {aboutContent.stats.map((stat, index) => (
                    <motion.div
                      key={stat.label}
                      initial={{ opacity: 0, y: 10 }}
                      whileInView={{ opacity: 1, y: 0 }}
                      viewport={{ once: true }}
                      transition={{ delay: 0.4 + index * 0.1 }}
                    >
                      <p className="text-4xl font-heading font-bold text-primary mb-1">
                        {stat.value}
                      </p>
                      <p className="text-muted-foreground text-sm">
                        {stat.label}
                      </p>
                    </motion.div>
                  ))}
                </motion.div>

                {/* Avatar placeholder */}
                <motion.div
                  className="mt-6 aspect-square rounded-2xl bg-gradient-to-br from-primary/20 to-accent/20 flex items-center justify-center overflow-hidden"
                  initial={{ opacity: 0, scale: 0.95 }}
                  whileInView={{ opacity: 1, scale: 1 }}
                  viewport={{ once: true }}
                  transition={{ delay: 0.5 }}
                >
                  <div className="text-6xl font-heading font-bold text-primary/30">
                    AC
                  </div>
                </motion.div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </MainLayout>
  );
};

export default About;
